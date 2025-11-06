<?php
require_once __DIR__ . '/../db.php';
require_once dirname(__DIR__) . '/config.php';
$mysqli = db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método não suportado']);
  exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$company = trim($_POST['company'] ?? '');
$source = trim($_POST['source'] ?? '');
$status = trim($_POST['status'] ?? 'novo');

if ($name === '') {
  http_response_code(400);
  echo json_encode(['error' => 'Nome é obrigatório']);
  exit;
}

$allowed = allowed_statuses();
if (!in_array($status, $allowed, true)) { $status = 'novo'; }

$stmt = $mysqli->prepare("INSERT INTO leads (name, email, phone, company, source, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $name, $email, $phone, $company, $source, $status);
$ok = $stmt->execute();

$isPublic = isset($_POST['public']);
$redirect = trim($_POST['redirect'] ?? '');

if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
  header('Content-Type: application/json');
  echo json_encode(['success' => $ok, 'id' => $mysqli->insert_id]);
  exit;
}

// Redireciona conforme origem
if ($isPublic && $redirect !== '') {
  header('Location: ' . $redirect);
} else {
  // Fallback: público volta para o site principal, interno volta para Leads
  $dest = $isPublic ? '/index_site.php?success=1' : '/pages/leads.php';
  header('Location: ' . $BASE_URL . $dest);
}
exit;