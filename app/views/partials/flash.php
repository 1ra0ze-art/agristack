<?php
$flash = getFlash();
if ($flash): ?>
<div class="alert alert-<?= e($flash['type']) ?>" role="alert">
  <?= $flash['type'] === 'success' ? '✅' : '⚠️' ?>
  <span><?= e($flash['message']) ?></span>
</div>
<?php endif; ?>
