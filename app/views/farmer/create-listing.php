<?php $pageTitle = 'New Listing'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Post New Harvest Listing</div>
    <div class="page-subtitle">Your listing will be reviewed by admin before going live</div>
  </div>
  <a href="<?= BASE_URL ?>/farmer/listings" class="btn btn-outline">← Back</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card" style="max-width:700px">
    <div class="card-body">
      <form method="POST" action="<?= BASE_URL ?>/farmer/listings/create">
        <div class="form-group">
          <label class="form-label" for="title">Listing Title <span class="req">*</span></label>
          <input class="form-control" type="text" id="title" name="title" value="Irish Potato Harvest" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="quantity_kg">Total Quantity (kg) <span class="req">*</span></label>
            <input class="form-control" type="number" id="quantity_kg" name="quantity_kg" min="1" step="0.01" required placeholder="e.g. 500">
          </div>
          <div class="form-group">
            <label class="form-label" for="price_per_kg">Price per kg (RWF) <span class="req">*</span></label>
            <input class="form-control" type="number" id="price_per_kg" name="price_per_kg" min="1" step="0.01" required placeholder="e.g. 250">
          </div>
        </div>

        <!-- Live estimator -->
        <div class="price-estimator" id="estimator" style="display:none">
          <div class="est-label">Estimated Total Value</div>
          <div class="est-value" id="est-total">0 RWF</div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="pickup_sector">Pickup Sector <span class="req">*</span></label>
            <input class="form-control" type="text" id="pickup_sector" name="pickup_sector" required placeholder="e.g. Kinigi, Musanze">
          </div>
          <div class="form-group">
            <label class="form-label" for="harvest_date">Available/Harvest Date <span class="req">*</span></label>
            <input class="form-control" type="date" id="harvest_date" name="harvest_date" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="description">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Describe quality, packaging, special notes..."></textarea>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Submit for Review →</button>
          <a href="<?= BASE_URL ?>/farmer/listings" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function() {
  const qtyEl   = document.getElementById('quantity_kg');
  const priceEl = document.getElementById('price_per_kg');
  const est     = document.getElementById('estimator');
  const total   = document.getElementById('est-total');

  function update() {
    const qty   = parseFloat(qtyEl.value)   || 0;
    const price = parseFloat(priceEl.value) || 0;
    if (qty > 0 && price > 0) {
      est.style.display = 'block';
      total.textContent = new Intl.NumberFormat('en-RW').format(qty * price) + ' RWF';
    } else {
      est.style.display = 'none';
    }
  }

  qtyEl.addEventListener('input', update);
  priceEl.addEventListener('input', update);
})();
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
