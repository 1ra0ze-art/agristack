<?php $pageTitle = 'Dashboard'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Buyer Dashboard</div>
    <div class="page-subtitle">Your bulk order overview</div>
  </div>
  <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-primary">🔍 Browse Listings</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Total Bookings</div>
      <div class="stat-value"><?= $stats['total'] ?? 0 ?></div>
      <div class="stat-sub">All time</div>
    </div>
    <div class="stat-card gold">
      <div class="stat-label">Total Value</div>
      <div class="stat-value" style="font-size:1.4rem"><?= formatRwf($stats['total_value'] ?? 0) ?></div>
      <div class="stat-sub">Approved + Collected orders</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Pending</div>
      <div class="stat-value"><?= $stats['pending_count'] ?? 0 ?></div>
      <div class="stat-sub">Awaiting approval</div>
    </div>
    <div class="stat-card blue">
      <div class="stat-label">Collected</div>
      <div class="stat-value"><?= $stats['collected_count'] ?? 0 ?></div>
      <div class="stat-sub">Orders fulfilled</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3>Quick Actions</h3>
    </div>
    <div class="card-body" style="display:flex;gap:12px;flex-wrap:wrap">
      <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-primary">🔍 Browse Available Listings</a>
      <a href="<?= BASE_URL ?>/buyer/bookings" class="btn btn-outline">📦 View My Bookings</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
