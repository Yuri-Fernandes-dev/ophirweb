<?php
require_once __DIR__ . '/../db.php';
$HIDE_MENU = true; // Página pública não deve exibir navegação
include __DIR__ . '/../header.php';
$success = isset($_GET['success']);
?>
<main class="container">
  <h1>Formulário de Lead • OPHIR SISTEMA</h1>
  <?php if ($success): ?>
    <div class="notice success">Obrigado! Recebemos seus dados e entraremos em contato.</div>
  <?php endif; ?>
  <div class="card">
    <form method="post" action="<?php echo $BASE_URL; ?>/api/create_lead.php">
      <input type="hidden" name="public" value="1" />
      <div class="form-row">
        <label>Nome</label>
        <input type="text" name="name" required />
      </div>
      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" required />
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
        <label>Como nos conheceu?</label>
        <input type="text" name="source" placeholder="Ex.: Google, Indicação" />
      </div>
      <button class="btn" type="submit">Enviar</button>
    </form>
  </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>