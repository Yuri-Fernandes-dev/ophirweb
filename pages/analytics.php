<?php
require_once __DIR__ . '/../db.php';
$REQUIRE_AUTH = true;
include __DIR__ . '/../header.php';
?>
<main class="container">
  <h1>Dashboard</h1>
  <div class="grid-3">
    <div class="card stat">
      <h3>Total de Leads</h3>
      <div class="number" id="stat-total">0</div>
      <ul class="status-list">
        <li><span id="stat-assinantes">0</span> assinantes</li>
        <li>Taxa de conversão: <span id="stat-conversion">0%</span></li>
      </ul>
    </div>
    <div class="card stat">
      <h3>Receita Mensal (MRR real)</h3>
      <div class="number" id="stat-mrr">R$ 0</div>
      <ul class="status-list">
        <li>Novos clientes no mês: <span id="stat-new-clients">0</span></li>
        <li>Leads convertidos no mês: <span id="stat-converted">0</span></li>
      </ul>
    </div>
    <div class="card stat">
      <h3>Destaques</h3>
      <ul class="status-list" id="highlights">
        <li>Maior estágio: <span id="stat-top-stage">—</span></li>
        <li>Dia com mais leads: <span id="stat-top-day">—</span></li>
      </ul>
    </div>
  </div>
  <div class="grid-2">
    <div class="card">
      <h3>Leads por Status</h3>
      <canvas id="chart-status" width="600" height="320"></canvas>
    </div>
    <div class="card">
      <h3>Leads por Origem</h3>
      <canvas id="chart-origem" width="600" height="320"></canvas>
    </div>
  </div>
</main>
<script>
  (function(){
    window.addEventListener('load', function(){
      const base = window.BASE_URL || '';
      fetch(base + '/api/get_stats.php').then(r=>r.json()).then(data=>{
      const labels = data.statuses.map(s=>s.label);
      const values = data.statuses.map(s=>s.count);
      drawBarChart('chart-status', labels, values, { title: 'Leads por Status' });

      const srcLabels = (data.sources||[]).map(s=>s.source);
      const srcValues = (data.sources||[]).map(s=>s.count);
      drawBarChart('chart-origem', srcLabels, srcValues, { title: 'Leads por Origem' });

      // Estatísticas agregadas
      const total = data.totals?.total || 0;
      const assinantes = data.totals?.assinantes || 0;
      const conversion = data.totals?.conversion || 0;
      $('#stat-total').textContent = String(total);
      $('#stat-assinantes').textContent = String(assinantes);
      $('#stat-conversion').textContent = conversion + '%';

      // Receita mensal real e KPIs
      const toBRL = (v) => 'R$ ' + (Number(v)||0).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      $('#stat-mrr').textContent = toBRL(data.totals?.mrr || 0);
      $('#stat-new-clients').textContent = String(data.totals?.new_clients_month || 0);
      $('#stat-converted').textContent = String(data.totals?.converted_month || 0);

      // Destaques simples
      let topStage = '—', topStageCount = -1;
      data.statuses.forEach(s => { if (s.count > topStageCount) { topStage = s.label; topStageCount = s.count; } });
      $('#stat-top-stage').textContent = topStage + ' (' + topStageCount + ')';
      let topSrc = '—', topSrcCount = -1;
      (data.sources||[]).forEach(s => { if (s.count > topSrcCount) { topSrc = s.source; topSrcCount = s.count; } });
      $('#stat-top-day').textContent = 'Origem: ' + topSrc + ' (' + topSrcCount + ')';
      });
    });
  })();
</script>
<?php include __DIR__ . '/../footer.php'; ?>