<?php
// ============================================================
// AgriStack — Database Configuration
// ============================================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');          // Change for production
define('DB_PASS', '');              // Change for production
define('DB_NAME', 'agristack');
define('DB_PORT', 3306);

define('BASE_URL', 'http://localhost/agristack');
define('APP_NAME', 'AgriStack');

// Error display (set false on production)
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
