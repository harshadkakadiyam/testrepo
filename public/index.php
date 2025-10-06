<?php
declare(strict_types=1);

session_start();

require __DIR__ . '/../libs/Database.php';
require __DIR__ . '/../libs/Util.php';

$config = require __DIR__ . '/../config/config.php';
$L = require __DIR__ . '/../locales/' . ($config['app']['locale'] ?? 'gu') . '.php';

// Routing
$module = $_GET['m'] ?? 'home';
$action = $_GET['a'] ?? 'index';

function view(string $template, array $data = []): void {
    global $L;
    extract($data, EXTR_SKIP);
    $viewFile = __DIR__ . '/../views/' . $template . '.php';
    if (!is_file($viewFile)) {
        http_response_code(404);
        echo 'View not found';
        return;
    }
    require __DIR__ . '/../views/partials/header.php';
    require $viewFile;
    require __DIR__ . '/../views/partials/footer.php';
}

// Controllers (lightweight inline dispatcher)
$controllerMap = [
    'home' => __DIR__ . '/../controllers/HomeController.php',
    'products' => __DIR__ . '/../controllers/ProductController.php',
    'customers' => __DIR__ . '/../controllers/CustomerController.php',
    'chalans' => __DIR__ . '/../controllers/ChalanController.php',
    'invoices' => __DIR__ . '/../controllers/InvoiceController.php',
    'reports' => __DIR__ . '/../controllers/ReportsController.php',
];

if (!isset($controllerMap[$module])) {
    http_response_code(404);
    echo 'Module not found';
    exit;
}
require_once $controllerMap[$module];

$callable = $module . '_' . $action;
if (!function_exists($callable)) {
    http_response_code(404);
    echo 'Action not found';
    exit;
}

$callable();
