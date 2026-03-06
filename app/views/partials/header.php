<?php
// ============================================================
// AgriStack — Shared Header Partial
// ============================================================
$u    = currentUser();
$role = $u['role'];
$nav  = [];

if ($role === 'farmer') {
    $nav = [
        '/farmer/dashboard'       => ['icon' => '📊', 'label' => 'Dashboard'],
        '/farmer/listings'        => ['icon' => '🌾', 'label' => 'My Listings'],
        '/farmer/listings/create' => ['icon' => '➕', 'label' => 'New Listing'],
        '/farmer/bookings'        => ['icon' => '📦', 'label' => 'Bookings'],
    ];
} elseif ($role === 'buyer') {
    $nav = [
        '/buyer/dashboard' => ['icon' => '📊', 'label' => 'Dashboard'],
        '/buyer/listings'  => ['icon' => '🔍', 'label' => 'Browse Listings'],
        '/buyer/bookings'  => ['icon' => '📦', 'label' => 'My Bookings'],
    ];
} elseif ($role === 'admin') {
    $nav = [
        '/admin/dashboard'  => ['icon' => '📊', 'label' => 'Dashboard'],
        '/admin/listings'   => ['icon' => '🌾', 'label' => 'Listings'],
        '/admin/bookings'   => ['icon' => '📦', 'label' => 'Bookings'],
        '/admin/users'      => ['icon' => '👥', 'label' => 'Users'],
        '/admin/audit-log'  => ['icon' => '📋', 'label' => 'Audit Log'],
    ];
}

$currentPath = strtok($_SERVER['REQUEST_URI'], '?');
$scriptBase  = dirname($_SERVER['SCRIPT_NAME']);
$currentPath = str_replace($scriptBase, '', $currentPath);
$currentPath = rtrim($currentPath, '/') ?: '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle) ? e($pageTitle) . ' — ' : '' ?>AgriStack</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌾</text></svg>">
</head>
<body>

<!-- Mobile Header -->
<div class="mobile-header">
  <span class="logo-text">🌾 AgriStack</span>
  <button id="sidebar-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')" aria-label="Toggle menu">☰</button>
</div>

<div class="app-layout">
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="logo-text">🌾 AgriStack</div>
      <div class="logo-sub">Irish Potato Marketplace</div>
    </div>
    <div class="sidebar-user">
      <div class="user-name"><?= e($u['name']) ?></div>
      <div class="user-role"><?= e(ucfirst($role)) ?></div>
    </div>
    <nav class="sidebar-nav">
      <?php foreach ($nav as $path => $item): ?>
        <a href="<?= BASE_URL . $path ?>" class="<?= $currentPath === $path ? 'active' : '' ?>">
          <span><?= $item['icon'] ?></span>
          <span><?= e($item['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="sidebar-footer">
      <a href="<?= BASE_URL ?>/logout">⬅ Logout</a>
    </div>
  </aside>

  <!-- Main -->
  <main class="main-content">
