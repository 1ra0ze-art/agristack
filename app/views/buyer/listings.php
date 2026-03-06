<?php $pageTitle = 'Browse Listings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Available Harvest Listings</div>
    <div class="page-subtitle">Browse approved Irish Potato listings from Musanze cooperatives</div>
  </div>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>

  <!-- Filters -->
  <form method="GET" action="<?= BASE_URL ?>/buyer/listings">
    <div class="filter-bar">
      <div class="form-group">
        <label class="form-label">Sector</label>
        <select class="form-control" name="sector">
          <option value="">All Sectors</option>
          <?php foreach ($sectors as $s): ?>
          <option value="<?= e($s['pickup_sector']) ?>" <?= ($_GET['sector'] ?? '') === $s['pickup_sector'] ? 'selected' : '' ?>><?= e($s['pickup_sector']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Min Qty (kg)</label>
        <input class="form-control" type="number" name="min_qty" value="<?= e($_GET['min_qty'] ?? '') ?>" placeholder="0" min="0">
      </div>
      <div class="form-group">
        <label class="form-label">Max Price/kg</label>
        <input class="form-control" type="number" name="max_price" value="<?= e($_GET['max_price'] ?? '') ?>" placeholder="Any" min="0">
      </div>
      <div class="form-group" style="align-self:flex-end">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-outline">Reset</a>
      </div>
    </div>
  </form>

  <?php if (empty($listings)): ?>
    <div class="empty-state">
      <div class="empty-icon">🌾</div>
      <h3>No listings found</h3>
      <p>Try adjusting your filters or check back later for new listings.</p>
    </div>
  <?php else: ?>
  <p style="margin-bottom:16px;color:var(--text-muted)"><?= count($listings) ?> listing<?= count($listings) !== 1 ? 's' : '' ?> available</p>
  <div class="listings-grid">
    <?php foreach ($listings as $l): ?>
    <div class="listing-card">
      <div class="listing-card-header">
        <div class="listing-card-title"><?= e($l['title']) ?></div>
        <div class="listing-card-farmer">by <?= e($l['farmer_name']) ?></div>
      </div>
      <div class="listing-card-body">
        <div class="listing-price">
          <div class="price-value"><?= number_format($l['price_per_kg']) ?></div>
          <div class="price-unit">RWF per kg</div>
        </div>
        <div class="listing-meta">
          <div class="listing-meta-item">📦 <span>Available: <strong><?= number_format($l['quantity_kg']) ?> kg</strong></span></div>
          <div class="listing-meta-item">📍 <span>Sector: <strong><?= e($l['pickup_sector']) ?></strong></span></div>
          <div class="listing-meta-item">📅 <span>Harvest: <strong><?= date('M j, Y', strtotime($l['harvest_date'])) ?></strong></span></div>
          <?php if ($l['description']): ?>
          <div class="listing-meta-item" style="align-items:flex-start">📝 <span style="font-size:0.8rem"><?= e(substr($l['description'], 0, 80)) ?>...</span></div>
          <?php endif; ?>
        </div>
        <a href="<?= BASE_URL ?>/buyer/book?id=<?= $l['id'] ?>" class="btn btn-primary" style="width:100%;justify-content:center;">
          Book Now →
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
