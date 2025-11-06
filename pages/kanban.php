<?php
require_once __DIR__ . '/../db.php';
$REQUIRE_AUTH = true;
include __DIR__ . '/../header.php';
$mysqli = db();

$labels = lead_status_labels();
// Ordem fixa do pipeline
$statuses = ['novo','leads','morno','quente','assinante'];

// Carrega leads por status
$leadsByStatus = [];
foreach ($statuses as $st) { $leadsByStatus[$st] = []; }
$res = $mysqli->query("SELECT id, name, email, phone, company, status, converted_client_id FROM leads ORDER BY created_at DESC");
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $pip = map_status_to_pipeline($row['status']);
    $row['status'] = $pip; // normaliza para o front
    $leadsByStatus[$pip][] = $row;
  }
}
?>
<main class="container">
  <h1>Kanban de Leads</h1>
  <div class="kanban">
    <?php foreach ($statuses as $st): ?>
      <div class="kanban-column" data-status="<?php echo h($st); ?>">
        <div class="kanban-column-header">
          <h3><?php echo h($labels[$st]); ?></h3>
          <span class="count"><?php echo count($leadsByStatus[$st]); ?></span>
        </div>
        <div class="kanban-dropzone" ondragover="event.preventDefault();">
          <?php foreach ($leadsByStatus[$st] as $lead): ?>
            <div class="kanban-card" draggable="true" data-id="<?php echo (int)$lead['id']; ?>" data-status="<?php echo h($lead['status']); ?>">
              <strong><?php echo h($lead['name']); ?></strong>
              <div class="card-meta">
                <?php if ($lead['company']) echo '<span>' . h($lead['company']) . '</span>'; ?>
                <?php if ($lead['email']) echo '<span>' . h($lead['email']) . '</span>'; ?>
                <?php if ($lead['phone']) echo '<span>' . h($lead['phone']) . '</span>'; ?>
              </div>
              <div class="card-actions">
                <?php if (!empty($lead['email'])): ?>
                  <a href="mailto:<?php echo h($lead['email']); ?>?subject=Contato%20Ophir%20Gest%C3%A3o">Email</a>
                <?php endif; ?>
                <?php if (!empty($lead['phone'])): ?>
                  <?php $digits = preg_replace('/\D+/', '', (string)$lead['phone']); if ($digits): ?>
                    <a href="https://wa.me/<?php echo $digits; ?>?text=Ol%C3%A1!%20Podemos%20falar%20sobre%20o%20Ophir%20Gest%C3%A3o?" target="_blank">WhatsApp</a>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if ($st === 'assinante'): ?>
                  <?php
                    $editLink = '';
                    if (!empty($lead['converted_client_id'])) {
                      $editLink = $BASE_URL . '/pages/clients.php?edit=' . (int)$lead['converted_client_id'];
                    } else {
                      $editLink = $BASE_URL . '/pages/clients.php?lookup=' . urlencode((string)($lead['email'] ?? ''));
                    }
                  ?>
                  <a href="<?php echo $editLink; ?>">Editar Assinatura</a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>