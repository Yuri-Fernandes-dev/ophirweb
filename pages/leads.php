<?php
require_once __DIR__ . '/../db.php';
$REQUIRE_AUTH = true;
include __DIR__ . '/../header.php';
$mysqli = db();

// Filtros
$q = trim($_GET['q'] ?? '');
$fstatus = trim($_GET['status'] ?? '');
$labels = lead_status_labels();
$allowed = array_keys($labels);
// Carrega lead para edição/conversão
$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$convertId = isset($_GET['convert']) ? (int)$_GET['convert'] : 0;
$editLead = null;
if ($editId) {
  $stmt = $mysqli->prepare("SELECT id, name, email, phone, company, source, status, notes FROM leads WHERE id=?");
  $stmt->bind_param('i', $editId);
  if ($stmt->execute()) { $r = $stmt->get_result(); $editLead = $r ? $r->fetch_assoc() : null; }
}
$convertLead = null;
if ($convertId) {
  $stmt = $mysqli->prepare("SELECT id, name, email, phone, company FROM leads WHERE id=?");
  $stmt->bind_param('i', $convertId);
  if ($stmt->execute()) { $r = $stmt->get_result(); $convertLead = $r ? $r->fetch_assoc() : null; }
}

// Carrega leads com filtro
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
$leads = [];
if ($types) {
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param($types, ...$params);
  if ($stmt->execute()) { $res = $stmt->get_result(); $leads = $res ? $res->fetch_all(MYSQLI_ASSOC) : []; }
} else {
  $res = $mysqli->query($sql);
  $leads = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}
?>
<main class="container">
  <h1>Leads</h1>
  <?php if ($editLead): ?>
    <div class="card" style="margin-bottom:16px;">
      <h3>Editar Lead</h3>
      <form method="post" action="<?php echo $BASE_URL; ?>/api/update_lead.php" class="grid-2">
        <input type="hidden" name="id" value="<?php echo (int)$editLead['id']; ?>" />
        <div class="form-row"><label>Nome</label><input type="text" name="name" required value="<?php echo h($editLead['name']); ?>" /></div>
        <div class="form-row"><label>Email</label><input type="email" name="email" value="<?php echo h($editLead['email']); ?>" /></div>
        <div class="form-row"><label>Telefone</label><input type="text" name="phone" value="<?php echo h($editLead['phone']); ?>" /></div>
        <div class="form-row"><label>Empresa</label><input type="text" name="company" value="<?php echo h($editLead['company']); ?>" /></div>
        <div class="form-row"><label>Origem</label><input type="text" name="source" value="<?php echo h($editLead['source']); ?>" /></div>
        <div class="form-row"><label>Status</label>
          <select name="status">
            <?php foreach ($labels as $value => $label): ?><option value="<?php echo h($value); ?>" <?php echo ($editLead['status']===$value?'selected':''); ?>><?php echo h($label); ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="form-row" style="grid-column:1/-1"><label>Notas</label><input type="text" name="notes" value="<?php echo h($editLead['notes']); ?>" /></div>
        <div><button class="btn" type="submit">Salvar Alterações</button></div>
      </form>
    </div>
  <?php endif; ?>

  <?php if ($convertLead): ?>
    <div class="card" style="margin-bottom:16px;">
      <h3>Converter em Cliente</h3>
      <p>Lead: <strong><?php echo h($convertLead['name']); ?></strong> — <?php echo h($convertLead['email']); ?>, <?php echo h($convertLead['phone']); ?></p>
      <form method="post" action="<?php echo $BASE_URL; ?>/api/convert_lead_to_client.php" class="grid-2">
        <input type="hidden" name="id" value="<?php echo (int)$convertLead['id']; ?>" />
        <div class="form-row"><label>Plano (R$)</label><input type="number" name="plan_value" step="0.01" min="0" required /></div>
        <div><button class="btn" type="submit">Converter e Salvar</button></div>
      </form>
    </div>
  <?php endif; ?>
  <div class="card" style="margin-bottom:16px;">
    <form method="get" action="<?php echo $BASE_URL; ?>/pages/leads.php" class="filter-grid">
      <div class="form-row">
        <label>Buscar</label>
        <input type="text" name="q" value="<?php echo h($q); ?>" placeholder="Nome, email, telefone, empresa ou origem" />
      </div>
      <div class="form-row">
        <label>Status</label>
        <select name="status">
          <option value="">Todos</option>
          <?php foreach ($labels as $value => $label): ?>
            <option value="<?php echo h($value); ?>" <?php echo ($fstatus === $value ? 'selected' : ''); ?>><?php echo h($label); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="filter-actions">
        <button class="btn" type="submit">Filtrar</button>
        <a class="btn" href="<?php echo $BASE_URL; ?>/api/export_leads_csv.php<?php echo ($q||$fstatus) ? ('?'.http_build_query(['q'=>$q,'status'=>$fstatus])):''; ?>">Exportar CSV</a>
      </div>
    </form>
  </div>
  <div class="grid-2">
    <div class="card">
      <h3>Novo Lead</h3>
      <form method="post" action="<?php echo $BASE_URL; ?>/api/create_lead.php">
        <div class="form-row">
          <label>Nome</label>
          <input type="text" name="name" required />
        </div>
        <div class="form-row">
          <label>Email</label>
          <input type="email" name="email" />
        </div>
        <div class="form-row">
          <label>Telefone</label>
          <input type="text" name="phone" />
        </div>
        <div class="form-row">
          <label>Empresa</label>
          <input type="text" name="company" />
        </div>
        <div class="form-row">
          <label>Origem</label>
          <input type="text" name="source" placeholder="Ex.: Landing, Indicação" />
        </div>
        <div class="form-row">
          <label>Status</label>
          <select name="status">
            <?php foreach ($labels as $value => $label): ?>
              <option value="<?php echo h($value); ?>"><?php echo h($label); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="btn" type="submit">Salvar Lead</button>
      </form>
    </div>
    <div class="card">
      <h3>Lista de Leads</h3>
      <div class="table-wrap">
        <table class="table responsive">
          <thead>
            <tr>
              <th>Nome</th><th>Email</th><th>Telefone</th><th>Empresa</th><th>Origem</th><th>Status</th><th>Criado</th><th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($leads as $l): ?>
              <tr>
                <td data-label="Nome"><?php echo h($l['name']); ?></td>
                <td data-label="Email"><?php echo h($l['email']); ?></td>
                <td data-label="Telefone"><?php echo h($l['phone']); ?></td>
                <td data-label="Empresa"><?php echo h($l['company']); ?></td>
                <td data-label="Origem"><?php echo h($l['source']); ?></td>
                <td data-label="Status"><?php echo h($labels[$l['status']] ?? $l['status']); ?></td>
                <td data-label="Criado"><?php echo h($l['created_at']); ?></td>
                <td class="actions">
                  <a class="btn" href="<?php echo $BASE_URL; ?>/pages/leads.php?edit=<?php echo (int)$l['id']; ?>">Editar</a>
                  <a class="btn" href="<?php echo $BASE_URL; ?>/pages/leads.php?convert=<?php echo (int)$l['id']; ?>">Converter</a>
                  <form method="post" action="<?php echo $BASE_URL; ?>/api/delete_lead.php" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo (int)$l['id']; ?>" />
                    <button class="btn" style="background: var(--danger); margin-left:8px" onclick="return confirm('Excluir este lead? Esta ação é permanente.')">Excluir</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>