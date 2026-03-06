<?php $pageTitle = 'Dashboard'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Welcome back, <?= e(explode(' ', $user['name'])[0]) ?> 👋</div>
    <div class="page-subtitle">Here's your harvest overview for today</div>
  </div>
  <a href="<?= BASE_URL ?>/farmer/listings/create" class="btn btn-primary">➕ New Listing</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">My Listings</div>
      <div class="stat-value"><?= $stats['total_listings'] ?></div>
      <div class="stat-sub">Total posted</div>
    </div>
    <div class="stat-card gold">
      <div class="stat-label">Pending Review</div>
      <div class="stat-value"><?= $stats['pending_listings'] ?></div>
      <div class="stat-sub">Awaiting admin approval</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Approved</div>
      <div class="stat-value"><?= $stats['approved_listings'] ?></div>
      <div class="stat-sub">Visible to buyers</div>
    </div>
    <div class="stat-card blue">
      <div class="stat-label">Bookings Received</div>
      <div class="stat-value"><?= $stats['total_bookings'] ?></div>
      <div class="stat-sub">From buyers</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3>Recent Listings</h3>
      <a href="<?= BASE_URL ?>/farmer/listings" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div class="table-wrap">
      <?php if (empty($listings)): ?>
        <div class="empty-state">
          <div class="empty-icon">🌾</div>
          <h3>No listings yet</h3>
          <p>Post your first harvest listing to connect with buyers.</p>
          <a href="<?= BASE_URL ?>/farmer/listings/create" class="btn btn-primary" style="margin-top:16px">Post First Listing</a>
        </div>
      <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Title</th><th>Qty (kg)</th><th>Price/kg</th><th>Sector</th><th>Status</th><th>Date</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($listings, 0, 5) as $l): ?>
          <tr>
            <td><strong><?= e($l['title']) ?></strong></td>
            <td><?= number_format($l['quantity_kg']) ?> kg</td>
            <td><?= formatRwf($l['price_per_kg']) ?></td>
            <td><?= e($l['pickup_sector']) ?></td>
            <td><?= statusBadge($l['status']) ?></td>
            <td><?= date('M j', strtotime($l['created_at'])) ?></td>
            <td>
              <?php if ($l['status'] === 'pending'): ?>
              <div class="action-group">
                <a href="<?= BASE_URL ?>/farmer/listings/edit?id=<?= $l['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                <a href="<?= BASE_URL ?>/farmer/listings/delete?id=<?= $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this listing?')">Del</a>
              </div>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:0.8rem;">Locked</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>

  <?php if (!empty($bookings)): ?>
  <div class="card">
    <div class="card-header">
      <h3>Recent Bookings on My Listings</h3>
      <a href="<?= BASE_URL ?>/farmer/bookings" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Buyer</th><th>Listing</th><th>Qty</th><th>Value</th><th>Status</th></tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($bookings, 0, 5) as $b): ?>
          <tr>
            <td><?= e($b['buyer_name']) ?></td>
            <td><?= e($b['listing_title']) ?></td>
            <td><?= number_format($b['quantity_kg']) ?> kg</td>
            <td><?= formatRwf($b['total_value']) ?></td>
            <td><?= statusBadge($b['status']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
