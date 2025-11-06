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
$company_name = trim($_POST['company_name'] ?? '');
$contact_name = trim($_POST['contact_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$plan_value = trim($_POST['plan_value'] ?? '');
$plan_value_num = ($plan_value !== '' ? floatval(str_replace(',', '.', $plan_value)) : null);

if ($id <= 0 || $company_name === '') {
  http_response_code(400);
  echo json_encode(['error' => 'Dados inválidos']);
  exit;
}

$stmt = $mysqli->prepare("UPDATE clients SET company_name=?, contact_name=?, email=?, phone=?, plan_value=? WHERE id=?");
$stmt->bind_param('ssssdi', $company_name, $contact_name, $email, $phone, $plan_value_num, $id);
$ok = $stmt->execute();

if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
  header('Content-Type: application/json');
  echo json_encode(['success' => $ok]);
  exit;
}

header('Location: ' . $BASE_URL . '/pages/clients.php');
exit;