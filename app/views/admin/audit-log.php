<?php $pageTitle = 'Audit Log'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Audit Log</div>
    <div class="page-subtitle">Complete record of all platform actions — last 200 entries</div>
  </div>
  <span style="font-size:0.9rem;color:var(--text-muted)"><?= count($logs) ?> entries</span>
</div>
<div class="page-body">
  <div class="card">
    <div class="table-wrap">
      <?php if (empty($logs)): ?>
        <div class="empty-state"><div class="empty-icon">📋</div><h3>No audit entries yet</h3></div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Action</th><th>Performed By</th><th>Record Type</th><th>Record ID</th><th>Timestamp</th></tr>
        </thead>
        <tbody>
          <?php foreach ($logs as $i => $log): ?>
          <tr>
            <td style="color:var(--text-muted)"><?= $i+1 ?></td>
            <td class="audit-action"><?= e($log['action']) ?></td>
            <td><?= e($log['user_name'] ?? 'System') ?></td>
            <td>
              <?php if ($log['target_type']): ?>
              <span class="badge" style="background:#EEF2FF;color:#3730A3"><?= e(ucfirst($log['target_type'])) ?></span>
              <?php else: ?>—<?php endif; ?>
            </td>
            <td><?= $log['target_id'] ? '#' . $log['target_id'] : '—' ?></td>
            <td style="font-size:0.8rem;color:var(--text-muted);white-space:nowrap">
              <?= date('M j, Y H:i', strtotime($log['created_at'])) ?>
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
