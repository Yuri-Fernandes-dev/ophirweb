<?php
require_once __DIR__ . '/../db.php';
require_once dirname(__DIR__) . '/config.php';
$mysqli = db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método não suportado']);
  exit;
}

$id = (int)($_POST['id'] ?? 0);
$plan_value = trim($_POST['plan_value'] ?? '');
$plan_value_num = ($plan_value !== '' ? floatval(str_replace(',', '.', $plan_value)) : null);

if ($id <= 0 || $plan_value_num === null) {
  http_response_code(400);
  echo json_encode(['error' => 'Dados inválidos']);
  exit;
}

// Busca o lead
$stmt = $mysqli->prepare("SELECT name, email, phone, company FROM leads WHERE id=?");
$stmt->bind_param('i', $id);
$lead = null;
if ($stmt->execute()) { $res = $stmt->get_result(); $lead = $res ? $res->fetch_assoc() : null; }
if (!$lead) {
  http_response_code(404);
  echo json_encode(['error' => 'Lead não encontrado']);
  exit;
}

// Cria cliente
$company = $lead['company'] ?: $lead['name'];
$stmt2 = $mysqli->prepare("INSERT INTO clients (company_name, contact_name, email, phone, plan_value) VALUES (?, ?, ?, ?, ?)");
$contact = $lead['name'];
$stmt2->bind_param('ssssd', $company, $contact, $lead['email'], $lead['phone'], $plan_value_num);
$okClient = $stmt2->execute();
$newClientId = $okClient ? $mysqli->insert_id : null;

// Atualiza lead para assinante e vincula cliente criado
$stmt3 = $mysqli->prepare("UPDATE leads SET status='assinante', converted_client_id=? WHERE id=?");
$stmt3->bind_param('ii', $newClientId, $id);
$okLead = $stmt3->execute();

$ok = $okClient && $okLead;
if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
  header('Content-Type: application/json');
  echo json_encode(['success' => $ok]);
  exit;
}

header('Location: ' . $BASE_URL . '/pages/clients.php');
exit;