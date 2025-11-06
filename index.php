<?php
// Renderiza o site (index_site.php) e injeta um formulário de lead que envia ao CRM
require_once __DIR__ . '/config.php';
ob_start();
include __DIR__ . '/index_site.php';
$html = ob_get_clean();

$successMsg = isset($_GET['success']) ? '<div style="position:fixed;top:80px;right:20px;background:#22c55e;color:#072b19;padding:12px 14px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.15);z-index:1000;">Obrigado! Recebemos seu contato.</div>' : '';

$form = '<section id="crm-lead-form" style="background:var(--light-bg);padding:40px 20px;margin-top:40px;">'
  .'<div class="container">'
  .'<div style="background:#fff;border-radius:12px;box-shadow:var(--shadow);padding:24px;border:1px solid #e5e7eb;">'
  .'<h2 style="margin:0 0 12px;color:var(--primary)">Solicite uma demonstração</h2>'
  .'<p style="color:var(--light-text);margin:0 0 16px;">Preencha seus dados e entraremos em contato. O lead vai direto para o CRM.</p>'
  .'<form method="post" action="'.$BASE_URL.'/api/create_lead.php" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">'
    .'<input type="hidden" name="public" value="1" />'
    .'<input type="hidden" name="redirect" value="'.$BASE_URL.'/index.php?success=1" />'
    .'<div><label>Nome</label><input name="name" required style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px"/></div>'
    .'<div><label>Email</label><input type="email" name="email" required style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px"/></div>'
    .'<div><label>Telefone</label><input name="phone" style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px"/></div>'
    .'<div><label>Empresa</label><input name="company" style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px"/></div>'
    .'<div style="grid-column:1 / -1"><label>Como nos conheceu?</label><input name="source" placeholder="Ex.: Google, Indicação" style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px"/></div>'
    .'<div style="grid-column:1 / -1;text-align:right"><button class="btn btn-primary" type="submit" style="padding:12px 24px;border-radius:8px;border:none;background:#2b6cb0;color:#fff">Enviar</button></div>'
  .'</form>'
  .'</div>'
  .'</div>'
  .'</section>';

// Injeta antes de </body>
$out = str_replace('</body>', $successMsg . $form . '</body>', $html);
echo $out;