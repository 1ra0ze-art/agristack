<?php $pageTitle = 'Manage Users'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Manage Users</div>
    <div class="page-subtitle">View and manage all registered accounts</div>
  </div>
  <span style="font-size:0.9rem;color:var(--text-muted)"><?= count($users) ?> total users</span>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Sector</th><th>Phone</th><th>Status</th><th>Joined</th><th>Action</th></tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $u['id'] ?></td>
            <td><strong><?= e($u['name']) ?></strong></td>
            <td><?= e($u['email']) ?></td>
            <td>
              <span class="badge" style="background:<?= ['farmer'=>'#D1FAE5','buyer'=>'#DBEAFE','admin'=>'#FEE2E2'][$u['role']] ?? '#F3F4F6' ?>;color:#374151">
                <?= ucfirst($u['role']) ?>
              </span>
            </td>
            <td><?= e($u['sector'] ?? '—') ?></td>
            <td><?= e($u['phone'] ?? '—') ?></td>
            <td>
              <?php if ($u['is_active']): ?>
                <span class="badge" style="background:#D1FAE5;color:#065F46">Active</span>
              <?php else: ?>
                <span class="badge" style="background:#FEE2E2;color:#991B1B">Inactive</span>
              <?php endif; ?>
            </td>
            <td style="font-size:0.8rem;color:var(--text-muted)"><?= date('M j, Y', strtotime($u['created_at'])) ?></td>
            <td>
              <?php if ($u['role'] !== 'admin'): ?>
              <a href="<?= BASE_URL ?>/admin/users/toggle?id=<?= $u['id'] ?>"
                 class="btn <?= $u['is_active'] ? 'btn-danger' : 'btn-success' ?> btn-sm"
                 onclick="return confirm('Toggle active status for <?= e($u['name']) ?>?')">
                <?= $u['is_active'] ? 'Deactivate' : 'Activate' ?>
              </a>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:0.8rem">Protected</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
