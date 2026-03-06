<?php $pageTitle = 'Manage Listings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Manage Listings</div>
    <div class="page-subtitle">Review, approve or reject harvest listings</div>
  </div>
  <div class="action-group">
    <a href="?status=" class="btn <?= !($_GET['status'] ?? '') ? 'btn-primary' : 'btn-outline' ?> btn-sm">All</a>
    <a href="?status=pending"  class="btn <?= ($_GET['status'] ?? '') === 'pending'  ? 'btn-primary' : 'btn-outline' ?> btn-sm">Pending</a>
    <a href="?status=approved" class="btn <?= ($_GET['status'] ?? '') === 'approved' ? 'btn-primary' : 'btn-outline' ?> btn-sm">Approved</a>
    <a href="?status=rejected" class="btn <?= ($_GET['status'] ?? '') === 'rejected' ? 'btn-primary' : 'btn-outline' ?> btn-sm">Rejected</a>
  </div>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($listings)): ?>
        <div class="empty-state"><div class="empty-icon">🌾</div><h3>No listings found</h3></div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Farmer</th><th>Title</th><th>Qty (kg)</th><th>Price/kg</th><th>Sector</th><th>Harvest Date</th><th>Status</th><th>Posted</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach ($listings as $i => $l): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $l['id'] ?></td>
            <td><strong><?= e($l['farmer_name']) ?></strong><br><small style="color:var(--text-muted)"><?= e($l['farmer_sector']) ?></small></td>
            <td><?= e($l['title']) ?></td>
            <td><?= number_format($l['quantity_kg']) ?></td>
            <td><?= formatRwf($l['price_per_kg']) ?></td>
            <td><?= e($l['pickup_sector']) ?></td>
            <td><?= date('M j, Y', strtotime($l['harvest_date'])) ?></td>
            <td><?= statusBadge($l['status']) ?></td>
            <td style="font-size:0.8rem;color:var(--text-muted)"><?= timeAgo($l['created_at']) ?></td>
            <td>
              <?php if ($l['status'] === 'pending'): ?>
              <div class="action-group">
                <a href="<?= BASE_URL ?>/admin/listings/approve?id=<?= $l['id'] ?>" class="btn btn-success btn-sm">✓ Approve</a>
                <a href="<?= BASE_URL ?>/admin/listings/reject?id=<?= $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Reject listing #<?= $l['id'] ?>?')">✗ Reject</a>
              </div>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:0.8rem;">—</span>
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
