<?php
function db(): mysqli {
  static $mysqli = null;
  if ($mysqli instanceof mysqli) return $mysqli;

  // Conecta ao servidor MySQL (XAMPP padrão: root sem senha)
  $mysqli = @new mysqli('localhost', 'root', '');
  if ($mysqli->connect_error) {
    die('Erro ao conectar ao MySQL: ' . $mysqli->connect_error);
  }

  // Cria o banco se não existir
  $mysqli->query("CREATE DATABASE IF NOT EXISTS crm_ophir CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
  $mysqli->select_db('crm_ophir');
  $mysqli->set_charset('utf8mb4');

  // Cria tabela de leads
  $mysqli->query(<<<SQL
  CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    company VARCHAR(255) NULL,
    source VARCHAR(100) NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'novo',
    notes TEXT NULL,
    converted_client_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX(status),
    INDEX(converted_client_id),
    INDEX(created_at)
  ) ENGINE=InnoDB;
  SQL);

  // Cria tabela de clientes
  $mysqli->query(<<<SQL
  CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    contact_name VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    plan_value DECIMAL(10,2) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(company_name)
  ) ENGINE=InnoDB;
  SQL);

  // Migração segura: adiciona plan_value se não existir
  $check = $mysqli->query("SHOW COLUMNS FROM clients LIKE 'plan_value'");
  if ($check && $check->num_rows === 0) {
    $mysqli->query("ALTER TABLE clients ADD COLUMN plan_value DECIMAL(10,2) NULL AFTER phone");
  }

  // Migração segura: adiciona converted_client_id em leads se não existir
  $check2 = $mysqli->query("SHOW COLUMNS FROM leads LIKE 'converted_client_id'");
  if ($check2 && $check2->num_rows === 0) {
    $mysqli->query("ALTER TABLE leads ADD COLUMN converted_client_id INT NULL AFTER notes");
    $mysqli->query("ALTER TABLE leads ADD INDEX (converted_client_id)");
  }

  return $mysqli;
}

function h(?string $s): string { return htmlspecialchars((string)$s ?? '', ENT_QUOTES, 'UTF-8'); }

// Mapeamento de status (valor => rótulo)
function lead_status_labels(): array {
  // Pipeline desejado: Novo, Leads, Morno, Quente, Assinante
  return [
    'novo' => 'Novo',
    'leads' => 'Leads',
    'morno' => 'Morno',
    'quente' => 'Quente',
    'assinante' => 'Assinante',
  ];
}

function allowed_statuses(): array { return array_keys(lead_status_labels()); }

// Mapeia status antigos/variantes para o pipeline atual
function map_status_to_pipeline(string $s): string {
  $s = strtolower(trim($s));
  switch ($s) {
    case 'novo': return 'novo';
    case 'contato':
    case 'perdido':
    case 'lead':
    case 'leads': return 'leads';
    case 'proposta':
    case 'morno': return 'morno';
    case 'negociacao':
    case 'quente': return 'quente';
    case 'ganho':
    case 'assinante': return 'assinante';
    default: return 'leads';
  }
}

// Lista de variantes para usar em filtros (status IN (...))
function status_source_variants(string $pipelineStatus): array {
  switch (strtolower($pipelineStatus)) {
    case 'novo': return ['novo'];
    case 'leads': return ['leads','lead','contato','perdido'];
    case 'morno': return ['morno','proposta'];
    case 'quente': return ['quente','negociacao'];
    case 'assinante': return ['assinante','ganho'];
    default: return [$pipelineStatus];
  }
}

?>