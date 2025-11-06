<?php
require_once __DIR__ . '/../db.php';
$mysqli = db();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método não suportado']);
  exit;
}

$id = (int)($_POST['id'] ?? 0);
$status = trim($_POST['status'] ?? '');

if ($id <= 0 || $status === '') {
  http_response_code(400);
  echo json_encode(['error' => 'Parâmetros inválidos']);
  exit;
}

$allowed = allowed_statuses();
if (!in_array($status, $allowed, true)) {
  http_response_code(400);
  echo json_encode(['error' => 'Status inválido']);
  exit;
}

$stmt = $mysqli->prepare("UPDATE leads SET status = ? WHERE id = ?");
$stmt->bind_param('si', $status, $id);
$ok = $stmt->execute();

echo json_encode(['success' => $ok]);
exit;