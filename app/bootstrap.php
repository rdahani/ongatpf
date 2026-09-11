<?php
/**
 * Bootstrap applicatif ATPF
 */

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('VIEW_PATH', ROOT_PATH . '/views');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('UPLOAD_PATH', ROOT_PATH . '/uploads');

$config = require CONFIG_PATH . '/app.php';
$dbConfig = require CONFIG_PATH . '/database.php';

date_default_timezone_set($config['timezone']);

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}

if ($config['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', STORAGE_PATH . '/logs/php-error.log');
}

if (session_status() === PHP_SESSION_NONE) {
    session_name($config['session_name']);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

require_once APP_PATH . '/helpers.php';
require_once APP_PATH . '/media.php';
require_once APP_PATH . '/Database.php';
require_once APP_PATH . '/Csrf.php';
require_once APP_PATH . '/Auth.php';
require_once APP_PATH . '/Router.php';
require_once APP_PATH . '/Controller.php';

// Autoload simple des modèles et contrôleurs
spl_autoload_register(function (string $class): void {
    $paths = [
        APP_PATH . '/Models/' . $class . '.php',
        APP_PATH . '/Controllers/' . $class . '.php',
        APP_PATH . '/Services/' . $class . '.php',
        APP_PATH . '/Middleware/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (is_file($path)) {
            require_once $path;
            return;
        }
    }
});

$GLOBALS['app_config'] = $config;
$GLOBALS['db_config'] = $dbConfig;

try {
    Database::connect($dbConfig);
} catch (Throwable $e) {
    if (str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/install') || str_contains($_SERVER['REQUEST_URI'] ?? '', 'install.php')) {
        // laisse l'installateur gérer
    } else {
        // Mode dégradé lecture seule avec données fichier si BDD indisponible
        $GLOBALS['db_offline'] = true;
    }
}

return $config;
