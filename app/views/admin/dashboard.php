<?php $pageTitle = 'Admin Dashboard'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Admin Dashboard</div>
    <div class="page-subtitle">Platform overview — AgriStack Marketplace</div>
  </div>
  <span style="font-size:0.8rem;color:var(--text-muted)"><?= date('l, F j Y') ?></span>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>

  <!-- Key Stats -->
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Today's Listings</div>
      <div class="stat-value"><?= $todayListings ?></div>
      <div class="stat-sub">New submissions today</div>
    </div>
    <div class="stat-card gold">
      <div class="stat-label">Total Booked Value</div>
      <div class="stat-value" style="font-size:1.3rem"><?= formatRwf($totalBooked) ?></div>
      <div class="stat-sub">Approved + collected orders</div>
    </div>
    <div class="stat-card blue">
      <div class="stat-label">Active Users</div>
      <div class="stat-value"><?= $activeUsers ?></div>
      <div class="stat-sub">Registered on platform</div>
    </div>
    <div class="stat-card red">
      <div class="stat-label">Pending Approvals</div>
      <div class="stat-value"><?= count($pendingListings) ?></div>
      <div class="stat-sub">Listings awaiting review</div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px" class="dash-grid">
    <!-- Pending Listings -->
    <div class="card">
      <div class="card-header">
        <h3>⏳ Pending Listings (<?= count($pendingListings) ?>)</h3>
        <a href="<?= BASE_URL ?>/admin/listings?status=pending" class="btn btn-outline btn-sm">View All</a>
      </div>
      <div class="table-wrap">
        <?php if (empty($pendingListings)): ?>
          <div class="empty-state" style="padding:30px">
            <div class="empty-icon">✅</div>
            <h3>All clear!</h3>
            <p>No pending listings to review.</p>
          </div>
        <?php else: ?>
        <table>
          <thead>
            <tr><th>Farmer</th><th>Qty</th><th>Price</th><th>Sector</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php foreach (array_slice($pendingListings, 0, 8) as $l): ?>
            <tr>
              <td>
                <strong><?= e($l['farmer_name']) ?></strong><br>
                <small style="color:var(--text-muted)"><?= e($l['title']) ?></small>
              </td>
              <td><?= number_format($l['quantity_kg']) ?> kg</td>
              <td><?= formatRwf($l['price_per_kg']) ?></td>
              <td><?= e($l['pickup_sector']) ?></td>
              <td>
                <div class="action-group">
                  <a href="<?= BASE_URL ?>/admin/listings/approve?id=<?= $l['id'] ?>" class="btn btn-success btn-sm">✓ Approve</a>
                  <a href="<?= BASE_URL ?>/admin/listings/reject?id=<?= $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Reject this listing?')">✗ Reject</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
    </div>

    <!-- Top Sectors + Audit -->
    <div>
      <div class="card" style="margin-bottom:24px">
        <div class="card-header"><h3>📍 Top Pickup Sectors</h3></div>
        <div class="card-body">
          <?php if (empty($topSectors)): ?>
            <p style="color:var(--text-muted);font-size:0.9rem">No data yet.</p>
          <?php else: ?>
          <div class="sector-list">
            <?php foreach ($topSectors as $i => $s): ?>
            <div class="sector-item">
              <span><?= ['🥇','🥈','🥉'][$i] ?? '📍' ?> <strong><?= e($s['pickup_sector']) ?></strong></span>
              <span style="font-size:0.8rem;color:var(--text-muted)"><?= number_format($s['total_qty']) ?> kg</span>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3>📋 Recent Activity</h3>
          <a href="<?= BASE_URL ?>/admin/audit-log" class="btn btn-outline btn-sm">Full Log</a>
        </div>
        <div class="card-body" style="padding:0">
          <?php if (empty($recentAudit)): ?>
            <p style="padding:16px;color:var(--text-muted)">No activity yet.</p>
          <?php else: ?>
          <?php foreach (array_slice($recentAudit, 0, 6) as $log): ?>
          <div style="padding:10px 16px;border-bottom:1px solid var(--border);font-size:0.8rem">
            <div style="color:var(--text-dark)"><?= e($log['action']) ?></div>
            <div style="color:var(--text-muted)"><?= e($log['user_name']) ?> · <?= timeAgo($log['created_at']) ?></div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
@media (max-width: 768px) { .dash-grid { grid-template-columns: 1fr !important; } }
</style>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
