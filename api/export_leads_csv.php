<?php
require_once __DIR__ . '/../db.php';
require_once dirname(__DIR__) . '/config.php';
$mysqli = db();

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="leads.csv"');

$q = trim($_GET['q'] ?? '');
$fstatus = trim($_GET['status'] ?? '');
$labels = lead_status_labels();
$allowed = array_keys($labels);

$sql = "SELECT id, name, email, phone, company, source, status, created_at FROM leads WHERE 1=1";
$types = '';
$params = [];
if ($fstatus && in_array($fstatus, $allowed, true)) {
  $variants = status_source_variants($fstatus);
  $place = implode(',', array_fill(0, count($variants), '?'));
  $sql .= " AND status IN ($place)"; $types .= str_repeat('s', count($variants)); $params = array_merge($params, $variants);
}
if ($q !== '') {
  $like = '%' . $q . '%';
  $sql .= " AND (name LIKE ? OR email LIKE ? OR phone LIKE ? OR company LIKE ? OR source LIKE ?)";
  $types .= 'sssss';
  array_push($params, $like, $like, $like, $like, $like);
}
$sql .= " ORDER BY created_at DESC";

if ($types) { $stmt = $mysqli->prepare($sql); $stmt->bind_param($types, ...$params); $stmt->execute(); $res = $stmt->get_result(); }
else { $res = $mysqli->query($sql); }

$out = fopen('php://output', 'w');
fputcsv($out, ['ID','Nome','Email','Telefone','Empresa','Origem','Status','Criado']);
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $row['status'] = $labels[$row['status']] ?? $row['status'];
    fputcsv($out, [$row['id'],$row['name'],$row['email'],$row['phone'],$row['company'],$row['source'],$row['status'],$row['created_at']]);
  }
}
fclose($out);
exit;
?>