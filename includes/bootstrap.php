<?php
declare(strict_types=1);

function load_env(string $path): void
{
    static $loaded = false;

    if ($loaded || !is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#') || !str_contains($trimmed, '=')) {
            continue;
        }

        [$name, $value] = explode('=', $trimmed, 2);
        $name = trim($name);
        $value = trim($value);

        if ($name === '') {
            continue;
        }

        $value = trim($value, " \t\n\r\0\x0B\"'");

        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;

        if (getenv($name) === false) {
            putenv($name . '=' . $value);
        }
    }

    $loaded = true;
}

function env(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return (string) $value;
}

function env_bool(string $key, bool $default = false): bool
{
    $value = env($key);

    if ($value === null) {
        return $default;
    }

    return in_array(strtolower(trim($value)), ['1', 'true', 'yes', 'on'], true);
}

function app_env(): string
{
    return strtolower(trim((string) (env('APP_ENV', 'production') ?? 'production')));
}

function app_debug(): bool
{
    return env_bool('APP_DEBUG', false);
}

function app_timezone(): string
{
    return env('APP_TIMEZONE', 'UTC') ?? 'UTC';
}

function is_production_env(): bool
{
    return !in_array(app_env(), ['local', 'development', 'dev', 'testing', 'test'], true);
}

function request_is_secure(): bool
{
    $forwardedProto = strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));

    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['SERVER_PORT'] ?? null) === '443')
        || $forwardedProto === 'https';
}

function configure_runtime(): void
{
    static $configured = false;

    if ($configured) {
        return;
    }

    $configured = true;
    error_reporting(E_ALL);
    ini_set('display_errors', app_debug() ? '1' : '0');
    ini_set('display_startup_errors', app_debug() ? '1' : '0');
    ini_set('log_errors', '1');

    $logDir = __DIR__ . '/../storage/logs';

    if (!is_dir($logDir)) {
        mkdir($logDir, 0775, true);
    }

    ini_set('error_log', $logDir . '/php-error.log');

    $timezone = app_timezone();

    if (in_array($timezone, timezone_identifiers_list(), true)) {
        date_default_timezone_set($timezone);
    }

    if (PHP_SAPI === 'cli' || session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $sessionName = env('SESSION_NAME', 'MIRROR_AGE_LMS_SESSION') ?? 'MIRROR_AGE_LMS_SESSION';
    $secureCookies = request_is_secure();

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_secure', $secureCookies ? '1' : '0');
    ini_set('session.cookie_samesite', 'Lax');

    session_name($sessionName);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $secureCookies,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function csrf_token(string $key): string
{
    configure_runtime();

    if (!isset($_SESSION['_csrf'][$key]) || !is_string($_SESSION['_csrf'][$key])) {
        $_SESSION['_csrf'][$key] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf'][$key];
}

function verify_csrf_token(string $key, ?string $token): bool
{
    configure_runtime();

    if (!is_string($token) || $token === '') {
        return false;
    }

    $sessionToken = $_SESSION['_csrf'][$key] ?? null;

    return is_string($sessionToken) && hash_equals($sessionToken, $token);
}

load_env(__DIR__ . '/../.env');
configure_runtime();

const SITE_NAME = 'Mirror Age Concepts';
const SITE_TAGLINE = 'Consulting, technology, and digital learning under one gateway.';
const RESOURCE_LINKS = [
    ['label' => 'Organization Certificate', 'url' => 'api/file/doc/cac_mirror_age_concepts.pdf', 'variant' => 'primary'],
    ['label' => 'Company Profile', 'url' => 'api/file/buss_profile.pdf', 'variant' => 'success'],
    ['label' => 'Brand Assets', 'url' => 'api/file/doc/company_doc.zip', 'variant' => 'warning'],
];
const PUBLIC_ROUTES = [
    'index.php' => '/',
    'about.php' => '/about.php',
    'contact.php' => '/contact.php',
];

function app_base_url(): string
{
    return rtrim(env('APP_URL', 'https://mirrorageconcepts.com') ?? 'https://mirrorageconcepts.com', '/');
}

function base_url(string $path = ''): string
{
    $normalizedPath = ltrim($path, '/');
    $basePath = base_path();

    if ($normalizedPath === '') {
        return $basePath !== '' ? $basePath . '/' : './';
    }

    if (isset(PUBLIC_ROUTES[$normalizedPath])) {
        $route = PUBLIC_ROUTES[$normalizedPath];

        if ($route === '/') {
            return $basePath !== '' ? $basePath . '/' : './';
        }

        return ($basePath !== '' ? $basePath : '') . rtrim($route, '/') . '/';
    }

    return ($basePath !== '' ? $basePath . '/' : '') . $normalizedPath;
}

function base_domain(): string
{
    return env('GATEWAY_BASE_DOMAIN', 'mirrorageconcepts.com') ?? 'mirrorageconcepts.com';
}

function contact_email(): string
{
    return env('CONTACT_EMAIL', 'info@mirrorageconcepts.com') ?? 'info@mirrorageconcepts.com';
}

function contact_phone_primary(): string
{
    return env('CONTACT_PHONE_PRIMARY', '+234 703 562 7734') ?? '+234 703 562 7734';
}

function contact_phone_secondary(): string
{
    return env('CONTACT_PHONE_SECONDARY', '+234 813 009 5597') ?? '+234 813 009 5597';
}

function contact_location(): string
{
    return env('CONTACT_LOCATION', 'Offa, Kwara State, Nigeria') ?? 'Offa, Kwara State, Nigeria';
}

function registration_number(): string
{
    return env('REGISTRATION_NUMBER', 'RC 3639510') ?? 'RC 3639510';
}

function suin_number(): string
{
    return env('SUIN_NUMBER', 'SUIN 81899894') ?? 'SUIN 81899894';
}

function gateway_links(): array
{
    $domain = base_domain();

    return [
        [
            'group' => 'Official Companies',
            'links' => [
                ['label' => 'Xtreem Data Touch Consulting', 'url' => 'https://xtreemdatatouchconsulting.' . $domain],
                ['label' => 'NextGen Technology', 'url' => 'https://nextgentech.' . $domain],
                ['label' => 'Grafix@Mirror LMS', 'url' => 'https://lms.' . $domain],
            ],
        ],
        [
            'group' => 'Quick Access',
            'links' => [
                ['label' => 'Official Website', 'url' => app_base_url()],
                ['label' => 'Learning Portal', 'url' => 'https://lms.' . $domain],
                ['label' => 'Kiosk Portal', 'url' => 'https://kiosk.' . $domain],
            ],
        ],
    ];
}

function base_path(): string
{
    $host = $_SERVER['HTTP_HOST'] ?? '';

    if ($host === 'localhost' || $host === '127.0.0.1' || str_contains($host, 'localhost:') || str_contains($host, '127.0.0.1:')) {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $projectRoot = realpath(__DIR__ . '/..');

        if (is_string($documentRoot) && $documentRoot !== '' && $projectRoot !== false) {
            $documentRootPath = realpath($documentRoot);

            if ($documentRootPath !== false) {
                $normalizedDocumentRoot = str_replace('\\', '/', rtrim($documentRootPath, '\\/'));
                $normalizedProjectRoot = str_replace('\\', '/', rtrim($projectRoot, '\\/'));

                if ($normalizedProjectRoot === $normalizedDocumentRoot) {
                    return '';
                }

                $documentRootPrefix = $normalizedDocumentRoot . '/';

                if (str_starts_with($normalizedProjectRoot, $documentRootPrefix)) {
                    return '/' . trim(substr($normalizedProjectRoot, strlen($documentRootPrefix)), '/');
                }
            }
        }
    }

    $appUrlPath = parse_url(app_base_url(), PHP_URL_PATH);

    if (is_string($appUrlPath) && $appUrlPath !== '' && $appUrlPath !== '/') {
        return rtrim($appUrlPath, '/');
    }

    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $directory = str_replace('\\', '/', dirname($scriptName));

    if ($directory === '/' || $directory === '.') {
        return '';
    }

    return rtrim($directory, '/');
}

function app_url(string $path = ''): string
{
    $normalizedPath = ltrim($path, '/');
    $basePath = base_path();

    if ($normalizedPath === '') {
        return $basePath !== '' ? $basePath . '/' : './';
    }

    if (isset(PUBLIC_ROUTES[$normalizedPath])) {
        $route = PUBLIC_ROUTES[$normalizedPath];

        if ($route === '/') {
            return $basePath !== '' ? $basePath . '/' : './';
        }

        return ($basePath !== '' ? $basePath : '') . rtrim($route, '/') . '/';
    }

    return ($basePath !== '' ? $basePath . '/' : '') . $normalizedPath;
}

function current_url(): string
{
    $scheme = request_is_secure() ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = strtok($uri, '?');

    if ($host === 'localhost' || $host === '127.0.0.1' || str_contains($host, 'localhost:') || str_contains($host, '127.0.0.1:')) {
        return $scheme . '://' . $host . $path;
    }

    return app_base_url() . $path;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function is_active_page(string $fileName): bool
{
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $requestPath = strtok($requestUri, '?');
    $requestPath = is_string($requestPath) ? rtrim($requestPath, '/') : '/';
    $requestPath = $requestPath === '' ? '/' : $requestPath;

    $basePath = base_path();

    if ($basePath !== '' && ($requestPath === $basePath || str_starts_with($requestPath, $basePath . '/'))) {
        $requestPath = substr($requestPath, strlen($basePath));
        $requestPath = $requestPath === '' ? '/' : $requestPath;
    }

    $routePath = PUBLIC_ROUTES[$fileName] ?? '/' . ltrim($fileName, '/');
    $directPath = '/' . ltrim($fileName, '/');

    if ($requestPath === $routePath || $requestPath === $directPath) {
        return true;
    }

    return basename($_SERVER['SCRIPT_NAME'] ?? '') === $fileName && $requestPath === '/';
}

function route_path(string $fileName): string
{
    return PUBLIC_ROUTES[$fileName] ?? '/' . ltrim($fileName, '/');
}

function render_head(string $title, string $description): void
{
    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= e($description) ?>">
  <meta name="robots" content="index, follow">
  <meta name="google-adsense-account" content="ca-pub-2438903956537959">
  <link rel="canonical" href="<?= e(current_url()) ?>">
  <title><?= e($title) ?> | <?= e(SITE_NAME) ?></title>
  <link rel="icon" type="image/png" href="<?= e(app_url('assets/img/logo.png')) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(app_url('assets/css/site.css')) ?>">
</head>
<body>
<?php
}

function render_header(): void
{
    $navItems = [
        ['label' => 'Home', 'url' => app_url('index.php'), 'active' => is_active_page('index.php')],
        ['label' => 'About', 'url' => app_url('about.php'), 'active' => is_active_page('about.php')],
        ['label' => 'Contact', 'url' => app_url('contact.php'), 'active' => is_active_page('contact.php')],
    ];
    ?>
<div class="topbar py-2 d-none d-lg-block">
  <div class="container d-flex justify-content-between align-items-center gap-3">
    <div class="d-flex align-items-center gap-3 small">
      <img src="<?= e(app_url('assets/img/logo.png')) ?>" alt="Mirror Age Concepts logo" class="topbar-logo">
      <span><strong><?= e(SITE_NAME) ?></strong></span>
      <span class="text-body-secondary"><?= e(registration_number()) ?></span>
      <span class="text-body-secondary"><?= e(suin_number()) ?></span>
    </div>
    <div class="small text-body-secondary d-flex align-items-center gap-3">
      <span><i class="fa-solid fa-phone me-1"></i><?= e(contact_phone_primary()) ?></span>
      <span><i class="fa-solid fa-envelope me-1"></i><?= e(contact_email()) ?></span>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg site-navbar sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= e(app_url('index.php')) ?>">
      <img src="<?= e(app_url('assets/img/logo.png')) ?>" alt="" class="brand-logo">
      <span><?= e(SITE_NAME) ?></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-controls="siteNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="siteNav">
      <ul class="navbar-nav me-auto mb-3 mb-lg-0">
        <?php foreach ($navItems as $item): ?>
          <li class="nav-item">
            <a class="nav-link<?= $item['active'] ? ' active' : '' ?>" href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a>
          </li>
        <?php endforeach; ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gateway Links</a>
          <div class="dropdown-menu dropdown-menu-lg p-3 border-0 shadow gateway-menu">
            <div class="row g-3">
              <?php foreach (gateway_links() as $group): ?>
                <div class="col-lg-6">
                  <p class="text-uppercase small fw-bold text-primary mb-2"><?= e($group['group']) ?></p>
                  <?php foreach ($group['links'] as $link): ?>
                    <a class="dropdown-item px-0 py-1" href="<?= e($link['url']) ?>" target="_blank" rel="noopener noreferrer"><?= e($link['label']) ?></a>
                  <?php endforeach; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </li>
      </ul>
      <div class="d-flex flex-wrap gap-2 align-items-center">
        <button class="btn btn-outline-secondary btn-sm" type="button" data-theme-toggle aria-label="Toggle color theme">
          <i class="fa-solid fa-moon"></i>
        </button>
        <a href="<?= e(app_url('contact.php')) ?>" class="btn btn-primary btn-sm">Start a Conversation</a>
      </div>
    </div>
  </div>
</nav>
<?php
}

function render_footer(): void
{
    $footerNav = [
        ['label' => 'Home', 'url' => app_url('index.php')],
        ['label' => 'About', 'url' => app_url('about.php')],
        ['label' => 'Contact', 'url' => app_url('contact.php')],
    ];
    $primaryPhoneHref = 'tel:' . preg_replace('/(?!^\+)[^\d]/', '', contact_phone_primary());
    $footerMeta = [
        ['icon' => 'fa-solid fa-building-shield', 'label' => 'Registration', 'value' => registration_number()],
        ['icon' => 'fa-solid fa-id-card', 'label' => 'SUIN', 'value' => suin_number()],
        ['icon' => 'fa-solid fa-location-dot', 'label' => 'Location', 'value' => contact_location()],
    ];
    ?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-shell">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="footer-brand">
            <a class="footer-brand-link" href="<?= e(app_url('index.php')) ?>">
              <img src="<?= e(app_url('assets/img/logo.png')) ?>" alt="" class="brand-logo">
              <span><?= e(SITE_NAME) ?></span>
            </a>
            <p class="footer-copy"><?= e(SITE_TAGLINE) ?></p>
            <a href="<?= e(app_url('contact.php')) ?>" class="btn btn-primary btn-sm">Start a Conversation</a>
          </div>
        </div>
        <div class="col-sm-6 col-lg-2">
          <h2 class="footer-title">Navigate</h2>
          <ul class="footer-list">
            <?php foreach ($footerNav as $item): ?>
              <li><a href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3">
          <h2 class="footer-title">Contact</h2>
          <ul class="footer-list footer-list-meta">
            <li><i class="fa-solid fa-envelope"></i><a href="mailto:<?= e(contact_email()) ?>"><?= e(contact_email()) ?></a></li>
            <li><i class="fa-solid fa-phone"></i><a href="<?= e($primaryPhoneHref) ?>"><?= e(contact_phone_primary()) ?></a></li>
            <li><i class="fa-brands fa-whatsapp"></i><a href="https://wa.me/2347035627734" target="_blank" rel="noopener noreferrer">WhatsApp chat</a></li>
          </ul>
        </div>
        <div class="col-sm-12 col-lg-3">
          <h2 class="footer-title">Company Metadata</h2>
          <ul class="footer-list footer-list-meta">
            <?php foreach ($footerMeta as $item): ?>
              <li><i class="<?= e($item['icon']) ?>"></i><span><strong><?= e($item['label']) ?>:</strong> <?= e($item['value']) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <small>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</small>
        <small>Official gateway for consulting, technology, and digital learning.</small>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="<?= e(app_url('assets/js/main.js')) ?>"></script>
</body>
</html>
<?php
}
