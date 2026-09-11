<?php

declare(strict_types=1);

function config(string $key = null, mixed $default = null): mixed
{
    $config = $GLOBALS['app_config'] ?? [];
    if ($key === null) {
        return $config;
    }
    $parts = explode('.', $key);
    $value = $config;
    foreach ($parts as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return $default;
        }
        $value = $value[$part];
    }
    return $value;
}

function base_path(string $path = ''): string
{
    $base = rtrim((string) config('base_path', ''), '/');
    if ($path === '' || $path === '/') {
        return $base === '' ? '/' : $base . '/';
    }
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return base_path(ltrim($path, '/'));
}

function url(string $path = ''): string
{
    return rtrim((string) config('url'), '/') . '/' . ltrim($path, '/');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function slugify(string $text): string
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
    return trim($text, '-') ?: 'item';
}

function redirect(string $path): never
{
    if (!str_starts_with($path, 'http')) {
        $path = base_path(ltrim($path, '/'));
    }
    header('Location: ' . $path);
    exit;
}

function old(string $key, string $default = ''): string
{
    return e((string) ($_SESSION['_old'][$key] ?? $default));
}

function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }
    $msg = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $msg;
}

function view(string $name, array $data = [], ?string $layout = 'layouts/main'): void
{
    extract($data, EXTR_SKIP);
    $viewFile = VIEW_PATH . '/' . str_replace('.', '/', $name) . '.php';
    if (!is_file($viewFile)) {
        http_response_code(500);
        echo 'Vue introuvable: ' . e($name);
        exit;
    }

    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    if ($layout) {
        $layoutFile = VIEW_PATH . '/' . str_replace('.', '/', $layout) . '.php';
        require $layoutFile;
    } else {
        echo $content;
    }
}

function partial(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require VIEW_PATH . '/partials/' . $name . '.php';
}

function is_active(string $path): bool
{
    $current = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
    $base = trim((string) config('base_path'), '/');
    if ($base && str_starts_with($current, $base)) {
        $current = trim(substr($current, strlen($base)), '/');
    }
    $path = trim($path, '/');
    if ($path === '') {
        return $current === '';
    }
    return $current === $path || str_starts_with($current, $path . '/');
}

function format_date(?string $date, string $format = 'd M Y'): string
{
    if (!$date) {
        return '';
    }
    $ts = strtotime($date);
    if (!$ts) {
        return '';
    }
    $months = [
        'Jan' => 'janv.', 'Feb' => 'févr.', 'Mar' => 'mars', 'Apr' => 'avr.',
        'May' => 'mai', 'Jun' => 'juin', 'Jul' => 'juil.', 'Aug' => 'août',
        'Sep' => 'sept.', 'Oct' => 'oct.', 'Nov' => 'nov.', 'Dec' => 'déc.',
    ];
    $out = date($format, $ts);
    return strtr($out, $months);
}

function truncate(string $text, int $limit = 160): string
{
    $text = trim(strip_tags($text));
    if (mb_strlen($text) <= $limit) {
        return $text;
    }
    return rtrim(mb_substr($text, 0, $limit - 1)) . '…';
}

/**
 * Autorise un sous-ensemble HTML sûr pour contenus éditoriaux.
 */
function sanitize_html(string $html): string
{
    $allowed = '<p><br><strong><em><ul><ol><li><a><h2><h3><blockquote>';
    $clean = strip_tags($html, $allowed);
    // Neutralise les javascript: dans les liens
    $clean = preg_replace('/\shref\s*=\s*(["\'])\s*javascript:[^"\']*\1/i', ' href="#"', $clean) ?? $clean;
    return $clean;
}

function setting(string $key, ?string $default = null): ?string
{
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        try {
            if (empty($GLOBALS['db_offline'])) {
                $rows = Database::fetchAll('SELECT setting_key, setting_value FROM site_settings');
                foreach ($rows as $row) {
                    $cache[$row['setting_key']] = $row['setting_value'];
                }
            }
        } catch (Throwable $e) {
            $cache = [];
        }
    }
    return $cache[$key] ?? $default;
}

function client_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function json_response(array $data, int $code = 200): never
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
