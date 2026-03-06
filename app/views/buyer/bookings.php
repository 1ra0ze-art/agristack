<?php $pageTitle = 'My Bookings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">My Bookings</div>
    <div class="page-subtitle">Track your bulk order requests</div>
  </div>
  <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-primary">+ New Booking</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($bookings)): ?>
        <div class="empty-state">
          <div class="empty-icon">📦</div>
          <h3>No bookings yet</h3>
          <p>Browse available listings and place your first bulk order.</p>
          <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-primary" style="margin-top:16px">Browse Listings</a>
        </div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Listing</th><th>Farmer</th><th>Sector</th><th>Qty Booked</th><th>Total Value</th><th>Pickup Date</th><th>Status</th><th>Placed</th></tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $i => $b): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $i+1 ?></td>
            <td><strong><?= e($b['listing_title']) ?></strong></td>
            <td><?= e($b['farmer_name']) ?></td>
            <td><?= e($b['pickup_sector']) ?></td>
            <td><?= number_format($b['quantity_kg']) ?> kg</td>
            <td><strong><?= formatRwf($b['total_value']) ?></strong></td>
            <td><?= date('M j, Y', strtotime($b['preferred_date'])) ?></td>
            <td><?= statusBadge($b['status']) ?></td>
            <td style="font-size:0.8rem;color:var(--text-muted)"><?= timeAgo($b['created_at']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
