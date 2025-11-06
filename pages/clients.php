<?php
require_once __DIR__ . '/../db.php';
$REQUIRE_AUTH = true;
include __DIR__ . '/../header.php';
$mysqli = db();

$res = $mysqli->query("SELECT id, company_name, contact_name, email, phone, plan_value, created_at FROM clients ORDER BY created_at DESC");
$clients = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
// Carrega cliente para edição
$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$lookup = trim($_GET['lookup'] ?? '');
$editClient = null;
if ($editId) {
  $stmt = $mysqli->prepare("SELECT id, company_name, contact_name, email, phone, plan_value FROM clients WHERE id=?");
  $stmt->bind_param('i', $editId);
  if ($stmt->execute()) { $r = $stmt->get_result(); $editClient = $r ? $r->fetch_assoc() : null; }
}
// Busca por email quando lookup é informado
if (!$editClient && $lookup !== '') {
  $stmt = $mysqli->prepare("SELECT id, company_name, contact_name, email, phone, plan_value FROM clients WHERE email=? LIMIT 1");
  $stmt->bind_param('s', $lookup);
  if ($stmt->execute()) { $r = $stmt->get_result(); $editClient = $r ? $r->fetch_assoc() : null; }
}
?>
<main class="container">
  <h1>Clientes</h1>
  <div class="grid-2">
    <div class="card">
      <h3><?php echo $editClient ? 'Editar Cliente' : 'Novo Cliente'; ?></h3>
      <form method="post" action="<?php echo $BASE_URL; ?>/api/<?php echo $editClient ? 'update_client.php' : 'create_client.php'; ?>">
        <?php if ($editClient): ?><input type="hidden" name="id" value="<?php echo (int)$editClient['id']; ?>" /><?php endif; ?>
        <div class="form-row">
          <label>Empresa</label>
          <input type="text" name="company_name" required value="<?php echo $editClient ? h($editClient['company_name']) : ''; ?>" />
        </div>
        <div class="form-row">
          <label>Contato</label>
          <input type="text" name="contact_name" value="<?php echo $editClient ? h($editClient['contact_name']) : ''; ?>" />
        </div>
        <div class="form-row">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo $editClient ? h($editClient['email']) : ''; ?>" />
        </div>
        <div class="form-row">
          <label>Telefone</label>
          <input type="text" name="phone" value="<?php echo $editClient ? h($editClient['phone']) : ''; ?>" />
        </div>
        <div class="form-row">
          <label>Plano (R$)</label>
          <input type="number" name="plan_value" step="0.01" min="0" value="<?php echo $editClient && $editClient['plan_value'] !== null ? h($editClient['plan_value']) : ''; ?>" />
        </div>
        <button class="btn" type="submit"><?php echo $editClient ? 'Atualizar Cliente' : 'Salvar Cliente'; ?></button>
      </form>
    </div>
    <div class="card">
      <h3>Lista de Clientes</h3>
      <div class="table-wrap">
        <table class="table responsive">
          <thead>
            <tr>
              <th>Empresa</th><th>Contato</th><th>Email</th><th>Telefone</th><th>Plano (R$)</th><th>Criado</th><th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clients as $c): ?>
              <tr>
                <td data-label="Empresa"><?php echo h($c['company_name']); ?></td>
                <td data-label="Contato"><?php echo h($c['contact_name']); ?></td>
                <td data-label="Email"><?php echo h($c['email']); ?></td>
                <td data-label="Telefone"><?php echo h($c['phone']); ?></td>
                <td data-label="Plano (R$)"><?php echo $c['plan_value'] !== null ? 'R$ ' . number_format((float)$c['plan_value'], 2, ',', '.') : '—'; ?></td>
                <td data-label="Criado"><?php echo h($c['created_at']); ?></td>
                <td data-label="Ações" class="actions">
                  <a class="btn" href="<?php echo $BASE_URL; ?>/pages/clients.php?edit=<?php echo (int)$c['id']; ?>">Editar</a>
                  <form method="post" action="<?php echo $BASE_URL; ?>/api/delete_client.php" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>" />
                    <button class="btn" style="background: var(--danger); margin-left:8px" onclick="return confirm('Excluir este cliente? Esta ação é permanente.')">Excluir</button>
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