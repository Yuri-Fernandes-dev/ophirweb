<?php
require_once __DIR__ . '/../db.php';
$mysqli = db();
header('Content-Type: application/json');

$labels = lead_status_labels();
$statuses = array_keys($labels);

// Contagens por pipeline (mapeando valores antigos)
$statusData = [];
$counts = array_fill_keys($statuses, 0);
$res = $mysqli->query("SELECT status, COUNT(*) AS c FROM leads GROUP BY status");
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $pip = map_status_to_pipeline($row['status']);
    $counts[$pip] = ($counts[$pip] ?? 0) + (int)$row['c'];
  }
}
foreach ($statuses as $st) {
  $statusData[] = ['status' => $st, 'label' => $labels[$st], 'count' => $counts[$st]];
}

$perDay = [];
$res = $mysqli->query("SELECT DATE(created_at) AS d, COUNT(*) AS c FROM leads GROUP BY DATE(created_at) ORDER BY d");
if ($res) {
  while ($row = $res->fetch_assoc()) { $perDay[] = ['date' => $row['d'], 'count' => (int)$row['c']]; }
}

// Contagem por origem
$sources = [];
$resS = $mysqli->query("SELECT COALESCE(NULLIF(TRIM(source),''), 'Não informado') AS s, COUNT(*) AS c FROM leads GROUP BY s ORDER BY c DESC");
if ($resS) {
  while ($row = $resS->fetch_assoc()) { $sources[] = ['source' => $row['s'], 'count' => (int)$row['c']]; }
}

// Estatísticas agregadas
$totalLeads = array_sum($counts);
$assinantes = $counts['assinante'] ?? 0;
$conversion = $totalLeads > 0 ? round(($assinantes / $totalLeads) * 100, 1) : 0.0;

// Receita mensal real (MRR) baseada nos clientes
$mrr = 0.0;
$resMrr = $mysqli->query("SELECT SUM(plan_value) AS total FROM clients");
if ($resMrr) { $row = $resMrr->fetch_assoc(); if ($row && $row['total'] !== null) { $mrr = (float)$row['total']; } }

// Novos clientes no mês
$newClientsMonth = 0;
$resNewCli = $mysqli->query("SELECT COUNT(*) AS c FROM clients WHERE DATE_FORMAT(created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')");
if ($resNewCli) { $r = $resNewCli->fetch_assoc(); $newClientsMonth = (int)($r['c'] ?? 0); }

// Leads convertidos no mês (pela data de atualização e status assinante)
$convertedMonth = 0;
$resConv = $mysqli->query("SELECT COUNT(*) AS c FROM leads WHERE status='assinante' AND DATE_FORMAT(updated_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')");
if ($resConv) { $rc = $resConv->fetch_assoc(); $convertedMonth = (int)($rc['c'] ?? 0); }

echo json_encode([
  'statuses' => $statusData,
  'leads_per_day' => $perDay,
  'sources' => $sources,
  'totals' => [
    'total' => $totalLeads,
    'assinantes' => $assinantes,
    'conversion' => $conversion,
    'mrr' => $mrr,
    'new_clients_month' => $newClientsMonth,
    'converted_month' => $convertedMonth,
  ],
]);
exit;