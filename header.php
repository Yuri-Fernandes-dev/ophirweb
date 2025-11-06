<?php
require_once __DIR__ . '/config.php';
if (isset($REQUIRE_AUTH) && $REQUIRE_AUTH) { require_login($BASE_URL); }
?><!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CRM • OPHIR SISTEMA</title>
  <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/css/styles.css" />
  <?php if (isset($SITE_THEME) && $SITE_THEME): ?>
  <style>
    :root { --primary:#0a55a4; --accent:#34d399; --text:#111827; --bg:#f8f9fa; --panel:#ffffff; --muted:#6b7280; }
    body { background: var(--bg); color: var(--text); }
    .topbar.no-nav { background:#ffffff; border-bottom: 1px solid #e5e7eb; }
    .brand { color: var(--primary); }
    .card { border-color:#e5e7eb; }
    .btn { background: var(--primary); color:#fff; }
    /* Ajustes para inputs claros no tema do site (login) */
    input, select, textarea { background:#ffffff; color: var(--text); border:1px solid #e5e7eb; }
    input::placeholder, textarea::placeholder { color: var(--muted); }
    .form-row input, .form-row select, .form-row textarea { width:100%; padding:12px; border-radius:8px; }
  </style>
  <?php endif; ?>
</head>
<body>
  <header class="topbar<?php echo isset($HIDE_MENU) && $HIDE_MENU ? ' no-nav' : ''; ?>">
    <div class="brand">OPHIR SISTEMA • CRM</div>
    <button class="hamburger" aria-label="Abrir menu" aria-expanded="false">☰</button>
    <?php if (!isset($HIDE_MENU) || !$HIDE_MENU): ?>
      <nav class="menu">
        <a href="<?php echo $BASE_URL; ?>/pages/kanban.php">Kanban</a>
        <a href="<?php echo $BASE_URL; ?>/pages/leads.php">Leads</a>
        <a href="<?php echo $BASE_URL; ?>/pages/clients.php">Clientes</a>
        <a href="<?php echo $BASE_URL; ?>/pages/analytics.php">Dashboard</a>
        
        <a href="<?php echo $BASE_URL; ?>/index_site.php" class="back" target="_blank">Voltar para o Site</a>
      </nav>
    <?php endif; ?>
  </header>