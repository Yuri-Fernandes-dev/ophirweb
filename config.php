<?php
// Sessão
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Calcula o prefixo base quando rodando em Apache/XAMPP (ex.: /crm) ou servidor embutido ("")
function base_url(): string {
  $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\','/', realpath($_SERVER['DOCUMENT_ROOT'])) : '';
  $projRoot = str_replace('\\','/', realpath(__DIR__));
  if (!$docRoot || !$projRoot) return '';
  if (strpos($projRoot, $docRoot) === 0) {
    $prefix = substr($projRoot, strlen($docRoot));
    return $prefix ? rtrim($prefix, '/') : '';
  }
  return '';
}

function is_cli_server(): bool { return php_sapi_name() === 'cli-server'; }

// Auth helpers
function is_logged_in(): bool { return isset($_SESSION['auth']) && $_SESSION['auth'] === true; }

function require_login(string $base): void {
  if (!is_logged_in()) {
    $loginPath = $base . (is_cli_server() ? '/login.php' : '/login');
    header('Location: ' . $loginPath);
    exit;
  }
}

// Disponibiliza base
$BASE_URL = base_url();
?>