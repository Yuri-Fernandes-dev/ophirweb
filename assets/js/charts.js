function drawBarChart(canvasId, labels, values, { title }={}) {
  const c = document.getElementById(canvasId);
  if (!c) return;
  const ctx = c.getContext('2d');
  const W = c.width, H = c.height;
  ctx.clearRect(0,0,W,H);
  // Background (claro)
  ctx.fillStyle = '#ffffff';
  ctx.fillRect(0,0,W,H);
  // Title
  if (title) {
    ctx.fillStyle = '#111827';
    ctx.font = '16px system-ui';
    ctx.fillText(title, 12, 22);
  }
  const max = Math.max(1, ...values);
  const padding = 40;
  const chartW = W - padding*2;
  const chartH = H - padding*2;
  const barW = chartW / values.length * 0.7;
  const gap = chartW / values.length * 0.3;
  // Axis (claro)
  ctx.strokeStyle = '#e5e7eb';
  ctx.beginPath();
  ctx.moveTo(padding, H - padding);
  ctx.lineTo(W - padding, H - padding);
  ctx.moveTo(padding, padding);
  ctx.lineTo(padding, H - padding);
  ctx.stroke();
  // Bars
  values.forEach((v, i) => {
    const x = padding + i * (barW + gap) + gap/2;
    const h = (v / max) * chartH;
    const y = H - padding - h;
    const colors = ['#0a55a4','#f7953c','#34d399','#60a5fa','#a78bfa','#fb7185'];
    ctx.fillStyle = colors[i % colors.length];
    ctx.fillRect(x, y, barW, h);
    // Label
    ctx.fillStyle = '#6b7280';
    ctx.font = '12px system-ui';
    const label = labels[i];
    ctx.fillText(String(label), x, H - padding + 14);
    ctx.fillStyle = '#111827';
    ctx.fillText(String(v), x, y - 4);
  });
}

function drawLineChart(canvasId, labels, values, { title }={}) {
  const c = document.getElementById(canvasId);
  if (!c) return;
  const ctx = c.getContext('2d');
  const W = c.width, H = c.height;
  ctx.clearRect(0,0,W,H);
  // Fundo claro
  ctx.fillStyle = '#ffffff';
  ctx.fillRect(0,0,W,H);
  if (title) { ctx.fillStyle = '#111827'; ctx.font='16px system-ui'; ctx.fillText(title, 12, 22); }
  const padding = 40;
  const chartW = W - padding*2;
  const chartH = H - padding*2;
  const max = Math.max(1, ...values);
  const stepX = chartW / Math.max(1, values.length - 1);
  // Axis
  ctx.strokeStyle = '#e5e7eb';
  ctx.beginPath();
  ctx.moveTo(padding, H - padding);
  ctx.lineTo(W - padding, H - padding);
  ctx.moveTo(padding, padding);
  ctx.lineTo(padding, H - padding);
  ctx.stroke();
  // Grid lines
  ctx.strokeStyle = '#f3f4f6';
  for (let i = 1; i <= 4; i++) {
    const y = padding + i * (chartH / 4);
    ctx.beginPath(); ctx.moveTo(padding, y); ctx.lineTo(W - padding, y); ctx.stroke();
  }
  // Line
  ctx.strokeStyle = '#0a55a4';
  ctx.lineWidth = 2;
  ctx.beginPath();
  values.forEach((v, i) => {
    const x = padding + i * stepX;
    const y = H - padding - (v / max) * chartH;
    if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
    // Points
    ctx.fillStyle = '#f7953c';
    ctx.beginPath(); ctx.arc(x, y, 3, 0, Math.PI*2); ctx.fill();
    // Labels
    ctx.fillStyle = '#6b7280'; ctx.font='12px system-ui';
    ctx.fillText(String(labels[i]), x, H - padding + 14);
  });
  ctx.stroke();
}