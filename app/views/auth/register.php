<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register — AgriStack</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>
<div class="auth-page">
  <div class="auth-hero">
    <div class="auth-hero-content">
      <div class="auth-hero-logo">🌾 AgriStack</div>
      <div class="auth-hero-tagline">Join 200+ farmers already selling direct.</div>
      <p class="auth-hero-desc">Create your account in under 2 minutes. Start posting harvest listings today.</p>
    </div>
  </div>
  <div class="auth-form-panel">
    <div class="auth-form-box">
      <h1 class="auth-form-title">Create account</h1>
      <p class="auth-form-sub">Join AgriStack as a farmer or buyer</p>

      <?php $flash = getFlash(); if ($flash): ?>
      <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>

      <form method="POST" action="<?= BASE_URL ?>/register">
        <div class="form-group">
          <label class="form-label">I am a <span class="req">*</span></label>
          <select class="form-control" name="role" required>
            <option value="farmer">🌾 Farmer / Cooperative</option>
            <option value="buyer">🛒 Aggregator / Buyer</option>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="name">Full Name <span class="req">*</span></label>
            <input class="form-control" type="text" id="name" name="name" required placeholder="Jean Damascène">
          </div>
          <div class="form-group">
            <label class="form-label" for="phone">Phone</label>
            <input class="form-control" type="tel" id="phone" name="phone" placeholder="+250788...">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="email">Email <span class="req">*</span></label>
          <input class="form-control" type="email" id="email" name="email" required placeholder="you@example.com">
        </div>
        <div class="form-group">
          <label class="form-label" for="sector">Sector / Location <span class="req">*</span></label>
          <input class="form-control" type="text" id="sector" name="sector" required placeholder="e.g. Kinigi, Musanze">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="password">Password <span class="req">*</span></label>
            <input class="form-control" type="password" id="password" name="password" required placeholder="min 6 chars">
          </div>
          <div class="form-group">
            <label class="form-label" for="confirm_password">Confirm Password <span class="req">*</span></label>
            <input class="form-control" type="password" id="confirm_password" name="confirm_password" required placeholder="repeat password">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
          Create Account →
        </button>
      </form>
      <p style="text-align:center;margin-top:20px;font-size:0.9rem;color:var(--text-muted);">
        Already have an account? <a href="<?= BASE_URL ?>/login">Sign in</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
