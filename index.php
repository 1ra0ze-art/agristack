<?php
// ============================================================
// AgriStack — Front Controller (index.php)
// ============================================================
require_once __DIR__ . '/app/core/config.php';
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/helpers.php';

startSession();

// Parse URL
$requestUri  = $_SERVER['REQUEST_URI'];
$scriptName  = dirname($_SERVER['SCRIPT_NAME']);
$path        = str_replace($scriptName, '', $requestUri);
$path        = strtok($path, '?');
$path        = rtrim($path, '/') ?: '/';

// ============================================================
// ROUTING TABLE
// ============================================================
$routes = [
    'GET' => [
        '/'                        => ['AuthController',    'index'],
        '/login'                   => ['AuthController',    'loginForm'],
        '/register'                => ['AuthController',    'registerForm'],
        '/logout'                  => ['AuthController',    'logout'],

        '/farmer/dashboard'        => ['FarmerController',  'dashboard'],
        '/farmer/listings'         => ['FarmerController',  'listings'],
        '/farmer/listings/create'  => ['FarmerController',  'createForm'],
        '/farmer/listings/edit'    => ['FarmerController',  'editForm'],
        '/farmer/listings/delete'  => ['FarmerController',  'delete'],
        '/farmer/bookings'         => ['FarmerController',  'bookings'],

        '/buyer/dashboard'         => ['BuyerController',   'dashboard'],
        '/buyer/listings'          => ['BuyerController',   'listings'],
        '/buyer/book'              => ['BuyerController',   'bookForm'],
        '/buyer/bookings'          => ['BuyerController',   'bookings'],

        '/admin/dashboard'         => ['AdminController',   'dashboard'],
        '/admin/listings'          => ['AdminController',   'listings'],
        '/admin/listings/approve'  => ['AdminController',   'approveListing'],
        '/admin/listings/reject'   => ['AdminController',   'rejectListing'],
        '/admin/bookings'          => ['AdminController',   'bookings'],
        '/admin/bookings/advance'  => ['AdminController',   'advanceBooking'],
        '/admin/users'             => ['AdminController',   'users'],
        '/admin/users/toggle'      => ['AdminController',   'toggleUser'],
        '/admin/audit-log'         => ['AdminController',   'auditLog'],
    ],
    'POST' => [
        '/login'                   => ['AuthController',    'login'],
        '/register'                => ['AuthController',    'register'],
        '/farmer/listings/create'  => ['FarmerController',  'create'],
        '/farmer/listings/edit'    => ['FarmerController',  'edit'],
        '/buyer/book'              => ['BuyerController',   'book'],
    ],
];

$method = $_SERVER['REQUEST_METHOD'];
$route  = $routes[$method][$path] ?? null;

if (!$route) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1><p>Page not found: $path</p><a href='" . BASE_URL . "/login'>← Back to Login</a>";
    exit;
}

[$controllerName, $action] = $route;

require_once __DIR__ . "/app/controllers/{$controllerName}.php";
$controller = new $controllerName();
$controller->$action();
