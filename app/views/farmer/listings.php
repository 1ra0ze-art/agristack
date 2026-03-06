<?php $pageTitle = 'My Listings'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">My Harvest Listings</div>
    <div class="page-subtitle">Manage your Irish Potato listings</div>
  </div>
  <a href="<?= BASE_URL ?>/farmer/listings/create" class="btn btn-primary">➕ New Listing</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($listings)): ?>
        <div class="empty-state">
          <div class="empty-icon">🌾</div>
          <h3>No listings yet</h3>
          <p>Create your first harvest listing to get started.</p>
          <a href="<?= BASE_URL ?>/farmer/listings/create" class="btn btn-primary" style="margin-top:16px">Create Listing</a>
        </div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Title</th><th>Quantity</th><th>Price/kg</th><th>Total Value</th><th>Sector</th><th>Harvest Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach ($listings as $i => $l): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $i+1 ?></td>
            <td><strong><?= e($l['title']) ?></strong><br><small style="color:var(--text-muted)"><?= e(substr($l['description'], 0, 50)) ?>...</small></td>
            <td><?= number_format($l['quantity_kg']) ?> kg</td>
            <td><?= formatRwf($l['price_per_kg']) ?></td>
            <td><strong><?= formatRwf($l['quantity_kg'] * $l['price_per_kg']) ?></strong></td>
            <td><?= e($l['pickup_sector']) ?></td>
            <td><?= date('M j, Y', strtotime($l['harvest_date'])) ?></td>
            <td><?= statusBadge($l['status']) ?></td>
            <td>
              <?php if ($l['status'] === 'pending'): ?>
              <div class="action-group">
                <a href="<?= BASE_URL ?>/farmer/listings/edit?id=<?= $l['id'] ?>" class="btn btn-outline btn-sm">✏️ Edit</a>
                <a href="<?= BASE_URL ?>/farmer/listings/delete?id=<?= $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this listing?')">🗑️ Delete</a>
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
