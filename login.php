<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Processa login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['username'] ?? '');
  $pass = trim($_POST['password'] ?? '');
  if ($user === 'lekyuri' && $pass === '37719582') {
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $user;
    header('Location: ' . $BASE_URL . '/pages/analytics.php');
    exit;
  } else {
    $error = 'Login ou senha inválidos';
  }
}

// Oculta menu; usa visual do site
$HIDE_MENU = true; $SITE_THEME = true;
include __DIR__ . '/header.php';
?>
<main class="container">
  <section class="card" style="max-width:560px;margin:40px auto;">
    <div style="text-align:center;margin-bottom:16px;">
      <img src="<?php echo $BASE_URL; ?>/logo.png" alt="OPHIR SISTEMA" style="max-height:72px;" />
      <h1 style="margin:10px 0 0;">Acesso ao CRM</h1>
      <p style="color:var(--muted);">Digite seu usuário e senha para entrar.</p>
    </div>
    <?php if ($error): ?>
      <div class="notice" style="background:#3f1d1d;border:1px solid #7f1d1d;color:#fca5a5;padding:10px;border-radius:8px;margin-bottom:12px;"><?php echo h($error); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo is_cli_server() ? ($BASE_URL . '/login.php') : ($BASE_URL . '/login'); ?>">
      <div class="form-row">
        <label>Usuário</label>
        <input type="text" name="username" placeholder="lekyuri" required />
      </div>
      <div class="form-row">
        <label>Senha</label>
        <input type="password" name="password" placeholder="••••••••" required />
      </div>
      <button class="btn" type="submit" style="width:100%;">Entrar</button>
    </form>
  </section>
</main>
<?php include __DIR__ . '/footer.php'; ?>