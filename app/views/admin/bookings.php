<?php $pageTitle = 'Manage Bookings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Manage Bookings</div>
    <div class="page-subtitle">Advance booking workflow: Pending → Approved → Collected</div>
  </div>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($bookings)): ?>
        <div class="empty-state"><div class="empty-icon">📦</div><h3>No bookings yet</h3></div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Buyer</th><th>Farmer</th><th>Listing</th><th>Sector</th><th>Qty (kg)</th><th>Total Value</th><th>Pickup Date</th><th>Status</th><th>Action</th></tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $b): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $b['id'] ?></td>
            <td><strong><?= e($b['buyer_name']) ?></strong></td>
            <td><?= e($b['farmer_name']) ?></td>
            <td><?= e($b['listing_title']) ?></td>
            <td><?= e($b['pickup_sector']) ?></td>
            <td><?= number_format($b['quantity_kg']) ?></td>
            <td><strong><?= formatRwf($b['total_value']) ?></strong></td>
            <td><?= date('M j, Y', strtotime($b['preferred_date'])) ?></td>
            <td><?= statusBadge($b['status']) ?></td>
            <td>
              <?php if ($b['status'] !== 'collected'): ?>
              <a href="<?= BASE_URL ?>/admin/bookings/advance?id=<?= $b['id'] ?>"
                 class="btn btn-warning btn-sm"
                 onclick="return confirm('Advance booking #<?= $b['id'] ?> to next status?')">
                ▶ Advance
              </a>
              <?php else: ?>
              <span style="color:var(--green-mid);font-size:0.8rem;font-weight:600">✓ Completed</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
