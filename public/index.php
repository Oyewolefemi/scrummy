<?php

// 1. Load Core Dependencies
require_once '../app/core/Env.php';
require_once '../app/core/Database.php';
require_once '../app/core/Session.php';
require_once '../app/core/functions.php'; // Your view() helper lives here

// 2. Load Environment Variables
Env::load(__DIR__ . '/../.env');

// 3. Start Session
Session::init();

// 4. Define Routes
$routes = [
    'GET' => [
        '/' => ['OrderController', 'index'],
        '/menu' => ['OrderController', 'menu'],
        '/item' => ['OrderController', 'item'],
        '/cart' => ['CartController', 'index'],
        '/checkout' => ['OrderController', 'checkout'],
        '/admin/login' => ['AdminController', 'login'],
        '/admin/dashboard' => ['AdminController', 'dashboard'],
    ],
    'POST' => [
        '/cart/add' => ['CartController', 'add'],
        '/cart/remove' => ['CartController', 'remove'],
        '/checkout/process' => ['OrderController', 'process'],
        '/admin/auth' => ['AdminController', 'authenticate'],
    ]
];

// 5. Parse the URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';
// Ensure leading slash for root matching
if ($url !== '/' && $url[0] !== '/') {
    $url = '/' . $url;
}
$method = $_SERVER['REQUEST_METHOD'];

// 6. Dispatch
if (isset($routes[$method][$url])) {
    [$controllerName, $action] = $routes[$method][$url];
    
    // Autoload the Controller
    require_once "../app/controllers/{$controllerName}.php";
    
    // Instantiate and Execute
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        die("Error: Method $action not found in $controllerName");
    }
} else {
    // Simple 404 Handling
    http_response_code(404);
    echo "404 - Page Not Found";
}