<?php $pageTitle = 'Book Listing'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Place Bulk Booking</div>
    <div class="page-subtitle">Submit your bulk order request for admin confirmation</div>
  </div>
  <a href="<?= BASE_URL ?>/buyer/listings" class="btn btn-outline">← Back to Listings</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;max-width:900px" class="booking-grid">

    <!-- Listing Summary -->
    <div class="card">
      <div class="card-header"><h3>🌾 Listing Details</h3></div>
      <div class="card-body">
        <h2 style="font-size:1.3rem;margin-bottom:16px"><?= e($listing['title']) ?></h2>
        <div class="listing-meta">
          <div class="listing-meta-item">👤 Farmer: <strong><?= e($listing['farmer_name']) ?></strong></div>
          <div class="listing-meta-item">📍 Sector: <strong><?= e($listing['pickup_sector']) ?></strong></div>
          <div class="listing-meta-item">📦 Available: <strong><?= number_format($listing['quantity_kg']) ?> kg</strong></div>
          <div class="listing-meta-item">📅 Harvest: <strong><?= date('M j, Y', strtotime($listing['harvest_date'])) ?></strong></div>
        </div>
        <div class="listing-price" style="margin-top:20px">
          <div class="price-value"><?= number_format($listing['price_per_kg']) ?></div>
          <div class="price-unit">RWF per kilogram</div>
        </div>
        <?php if ($listing['description']): ?>
        <p style="margin-top:16px;font-size:0.85rem"><?= e($listing['description']) ?></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="card">
      <div class="card-header"><h3>📦 Your Order</h3></div>
      <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/buyer/book">
          <input type="hidden" name="listing_id" value="<?= e($listing['id']) ?>">

          <div class="form-group">
            <label class="form-label" for="quantity_kg">
              Quantity to book (kg) <span class="req">*</span>
              <small style="font-weight:400;color:var(--text-muted)">Max: <?= number_format($listing['quantity_kg']) ?> kg</small>
            </label>
            <input class="form-control" type="number" id="quantity_kg" name="quantity_kg"
                   min="1" max="<?= $listing['quantity_kg'] ?>" step="0.01" required
                   placeholder="Enter quantity in kg">
          </div>

          <!-- LIVE PRICE ESTIMATOR -->
          <div class="price-estimator">
            <div class="est-label">💰 Estimated Total Cost</div>
            <div class="est-value" id="est-total">0 RWF</div>
            <div style="font-size:0.75rem;color:var(--text-muted);margin-top:4px">
              <span id="est-calc">Enter quantity above to see estimate</span>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="preferred_date">Preferred Pickup Date <span class="req">*</span></label>
            <input class="form-control" type="date" id="preferred_date" name="preferred_date" required
                   min="<?= date('Y-m-d') ?>">
          </div>

          <div class="form-group">
            <label class="form-label" for="notes">Notes / Special Requirements</label>
            <textarea class="form-control" id="notes" name="notes" placeholder="Loading time, packaging, invoice requirements..."></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit Booking Request →</button>
          </div>
          <p style="font-size:0.75rem;color:var(--text-muted);margin-top:12px">
            ℹ️ Your request will be reviewed by our admin team and confirmed within 24 hours.
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
@media (max-width: 640px) {
  .booking-grid { grid-template-columns: 1fr !important; }
}
</style>

<script>
(function() {
  const pricePerKg = <?= (float)$listing['price_per_kg'] ?>;
  const maxQty     = <?= (float)$listing['quantity_kg'] ?>;
  const qtyEl      = document.getElementById('quantity_kg');
  const totalEl    = document.getElementById('est-total');
  const calcEl     = document.getElementById('est-calc');

  qtyEl.addEventListener('input', function() {
    const qty = parseFloat(this.value) || 0;
    const total = qty * pricePerKg;

    totalEl.textContent = new Intl.NumberFormat('en-RW').format(total) + ' RWF';

    if (qty > 0 && qty <= maxQty) {
      calcEl.textContent = qty.toLocaleString() + ' kg × ' + pricePerKg.toLocaleString() + ' RWF/kg';
      totalEl.style.color = 'var(--green-dark)';
    } else if (qty > maxQty) {
      calcEl.textContent = '⚠️ Exceeds available quantity!';
      totalEl.style.color = 'var(--red)';
    } else {
      calcEl.textContent = 'Enter quantity above to see estimate';
      totalEl.style.color = 'var(--green-dark)';
    }
  });
})();
</script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
