<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login — AgriStack</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
<style>
  .auth-hero {
    background:
      linear-gradient(160deg, rgba(10,40,20,0.72) 0%, rgba(10,40,20,0.55) 100%),
      url('<?= BASE_URL ?>/public/images/potatoes.jpeg') center/cover no-repeat;
  }
</style>
</head>
<body>
<div class="auth-page">
  <div class="auth-hero">
    <div class="auth-hero-content">
      <div class="auth-hero-logo">🌾 AgriStack</div>
      <div class="auth-hero-tagline">"Fair prices. Direct access. Real income."</div>
      <p class="auth-hero-desc">
        Connecting Irish potato farmers and cooperatives in Musanze directly to bulk buyers — eliminating middlemen and restoring fair market value.
      </p>
      <div class="auth-hero-features">
        <div class="auth-hero-feature">Post harvest listings in minutes</div>
        <div class="auth-hero-feature">Access verified bulk buyers directly</div>
        <div class="auth-hero-feature">Track every order from booking to collection</div>
        <div class="auth-hero-feature">Admin-verified quality assurance</div>
      </div>
    </div>
  </div>

  <div class="auth-form-panel">
    <div class="auth-form-box">
      <h1 class="auth-form-title">Welcome back</h1>
      <p class="auth-form-sub">Sign in to your AgriStack account</p>

      <?php $flash = getFlash(); if ($flash): ?>
      <div class="alert alert-<?= e($flash['type']) ?>">
        <?= e($flash['message']) ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="<?= BASE_URL ?>/login">
        <div class="form-group">
          <label class="form-label" for="email">Email address <span class="req">*</span></label>
          <input class="form-control" type="email" id="email" name="email" required autofocus placeholder="you@example.com">
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password <span class="req">*</span></label>
          <input class="form-control" type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
          Sign In →
        </button>
      </form>

      <p style="text-align:center;margin-top:24px;font-size:0.9rem;color:var(--text-muted);">
        Don't have an account? <a href="<?= BASE_URL ?>/register">Register here</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
