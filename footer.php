<footer class="footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> OPHIR SISTEMA — CRM</p>
    </div>
  </footer>
  <?php if (!isset($BASE_URL)) { require_once __DIR__ . '/config.php'; } ?>
  <script>window.BASE_URL = '<?php echo $BASE_URL; ?>';</script>
  <script src="<?php echo $BASE_URL; ?>/assets/js/main.js"></script>
  <script src="<?php echo $BASE_URL; ?>/assets/js/kanban.js"></script>
  <script src="<?php echo $BASE_URL; ?>/assets/js/charts.js"></script>
</body>
</html>