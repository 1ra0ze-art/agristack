<?php $pageTitle = 'Edit Listing'; require_once __DIR__ . '/../partials/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-title">Edit Listing</div>
    <div class="page-subtitle">Update your pending harvest listing</div>
  </div>
  <a href="<?= BASE_URL ?>/farmer/listings" class="btn btn-outline">← Back</a>
</div>
<div class="page-body">
  <?php require_once __DIR__ . '/../partials/flash.php'; ?>
  <div class="card" style="max-width:700px">
    <div class="card-body">
      <form method="POST" action="<?= BASE_URL ?>/farmer/listings/edit">
        <input type="hidden" name="id" value="<?= e($listing['id']) ?>">
        <div class="form-group">
          <label class="form-label">Title <span class="req">*</span></label>
          <input class="form-control" type="text" name="title" value="<?= e($listing['title']) ?>" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Quantity (kg) <span class="req">*</span></label>
            <input class="form-control" type="number" name="quantity_kg" value="<?= e($listing['quantity_kg']) ?>" min="1" step="0.01" required id="qty">
          </div>
          <div class="form-group">
            <label class="form-label">Price/kg (RWF) <span class="req">*</span></label>
            <input class="form-control" type="number" name="price_per_kg" value="<?= e($listing['price_per_kg']) ?>" min="1" step="0.01" required id="price">
          </div>
        </div>
        <div class="price-estimator" id="estimator">
          <div class="est-label">Estimated Total Value</div>
          <div class="est-value" id="est-total"><?= formatRwf($listing['quantity_kg'] * $listing['price_per_kg']) ?></div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Pickup Sector <span class="req">*</span></label>
            <input class="form-control" type="text" name="pickup_sector" value="<?= e($listing['pickup_sector']) ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Harvest Date <span class="req">*</span></label>
            <input class="form-control" type="date" name="harvest_date" value="<?= e($listing['harvest_date']) ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description"><?= e($listing['description']) ?></textarea>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save Changes →</button>
          <a href="<?= BASE_URL ?>/farmer/listings" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
const q = document.getElementById('qty'), p = document.getElementById('price'), t = document.getElementById('est-total');
function upd() { const v = (parseFloat(q.value)||0)*(parseFloat(p.value)||0); t.textContent = new Intl.NumberFormat('en-RW').format(v)+' RWF'; }
q.addEventListener('input', upd); p.addEventListener('input', upd);
</script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
