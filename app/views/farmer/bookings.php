<?php $pageTitle = 'Bookings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Bookings on My Listings</div>
    <div class="page-subtitle">Orders placed by buyers against your harvest listings</div>
  </div>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($bookings)): ?>
        <div class="empty-state">
          <div class="empty-icon">📦</div>
          <h3>No bookings yet</h3>
          <p>Once buyers place orders on your approved listings, they'll appear here.</p>
        </div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>Buyer</th><th>Phone</th><th>Listing</th><th>Sector</th><th>Qty Booked</th><th>Total Value</th><th>Pickup Date</th><th>Status</th><th>Notes</th></tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $b): ?>
          <tr>
            <td><strong><?= e($b['buyer_name']) ?></strong></td>
            <td><?= e($b['buyer_phone']) ?></td>
            <td><?= e($b['listing_title']) ?></td>
            <td><?= e($b['pickup_sector']) ?></td>
            <td><?= number_format($b['quantity_kg']) ?> kg</td>
            <td><strong><?= formatRwf($b['total_value']) ?></strong></td>
            <td><?= date('M j, Y', strtotime($b['preferred_date'])) ?></td>
            <td><?= statusBadge($b['status']) ?></td>
            <td style="max-width:150px;font-size:0.8rem;color:var(--text-muted)"><?= e($b['notes']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
