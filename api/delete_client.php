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
if ($id <= 0) {
  http_response_code(400);
  echo json_encode(['error' => 'ID inválido']);
  exit;
}

$stmt = $mysqli->prepare('DELETE FROM clients WHERE id=?');
$stmt->bind_param('i', $id);
$ok = $stmt->execute();

if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
  header('Content-Type: application/json');
  echo json_encode(['success' => $ok]);
  exit;
}

header('Location: ' . $BASE_URL . '/pages/clients.php');
exit;