// Utilidades simples
window.$ = (sel, root=document) => root.querySelector(sel);
window.$$ = (sel, root=document) => Array.from(root.querySelectorAll(sel));

// Toast básico
function toast(msg, type='info') {
  const el = document.createElement('div');
  el.textContent = msg;
  el.className = 'toast ' + type;
  Object.assign(el.style, {
    position: 'fixed', bottom: '20px', right: '20px', padding: '10px 12px',
    background: type==='error' ? '#7f1d1d' : '#164e63', color: '#e5e7eb', borderRadius: '8px',
    border: '1px solid #1f2937', zIndex: 1000
  });
  document.body.appendChild(el);
  setTimeout(()=> el.remove(), 3000);
}

// Menu hambúrguer mobile
window.addEventListener('DOMContentLoaded', function(){
  const btn = document.querySelector('.hamburger');
  const menu = document.querySelector('.menu');
  if (!btn || !menu) return;
  btn.addEventListener('click', function(){
    const opened = menu.classList.toggle('open');
    btn.setAttribute('aria-expanded', opened ? 'true' : 'false');
  });
});