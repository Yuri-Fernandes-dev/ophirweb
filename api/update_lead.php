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
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$company = trim($_POST['company'] ?? '');
$source = trim($_POST['source'] ?? '');
$status = trim($_POST['status'] ?? '');
$notes = trim($_POST['notes'] ?? '');

if ($id <= 0 || $name === '') {
  http_response_code(400);
  echo json_encode(['error' => 'Dados inválidos']);
  exit;
}

// Valida status com pipeline
$labels = lead_status_labels();
if ($status !== '' && !array_key_exists($status, $labels)) { $status = 'novo'; }

$stmt = $mysqli->prepare("UPDATE leads SET name=?, email=?, phone=?, company=?, source=?, status=?, notes=? WHERE id=?");
$stmt->bind_param('sssssssi', $name, $email, $phone, $company, $source, $status, $notes, $id);
$ok = $stmt->execute();

if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
  header('Content-Type: application/json');
  echo json_encode(['success' => $ok]);
  exit;
}

header('Location: ' . $BASE_URL . '/pages/leads.php');
exit;