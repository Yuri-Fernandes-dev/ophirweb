function orderColumns() {
  const desired = ['novo','leads','morno','quente','assinante'];
  const board = $('.kanban');
  if (!board) return;
  const existing = $$('.kanban-column');
  const map = {};
  existing.forEach(col => { map[col.dataset.status] = col; });
  desired.forEach(k => { if (map[k]) board.appendChild(map[k]); });
}

document.addEventListener('DOMContentLoaded', () => {
  orderColumns();
  const cards = $$('.kanban-card');
  const zones = $$('.kanban-dropzone');

  let dragged = null;

  cards.forEach(c => {
    c.addEventListener('dragstart', () => {
      dragged = c;
      c.classList.add('dragging');
    });
    c.addEventListener('dragend', () => {
      c.classList.remove('dragging');
    });
  });

  zones.forEach(z => {
    z.addEventListener('dragover', (e) => {
      e.preventDefault();
      z.classList.add('highlight');
    });
    z.addEventListener('dragleave', () => {
      z.classList.remove('highlight');
    });
    z.addEventListener('drop', async (e) => {
      e.preventDefault();
      z.classList.remove('highlight');
      if (!dragged) return;
      const col = z.closest('.kanban-column');
      const newStatus = col.dataset.status;
      const leadId = parseInt(dragged.dataset.id, 10);
      try {
        const base = window.BASE_URL || '';
        const res = await fetch(base + '/api/update_lead_status.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ id: leadId, status: newStatus })
        });
        const json = await res.json();
        if (json.success) {
          z.appendChild(dragged);
          toast('Status atualizado');
          // Atualiza contadores
          const oldCol = document.querySelector(`.kanban-column[data-status="${dragged.dataset.status}"] .count`);
          const newCol = col.querySelector('.count');
          if (oldCol) oldCol.textContent = Math.max(0, parseInt(oldCol.textContent || '1', 10) - 1);
          if (newCol) newCol.textContent = parseInt(newCol.textContent || '0', 10) + 1;
          dragged.dataset.status = newStatus;
        } else {
          toast('Falha ao atualizar', 'error');
        }
      } catch (err) {
        toast('Erro de rede', 'error');
      }
    });
  });
});