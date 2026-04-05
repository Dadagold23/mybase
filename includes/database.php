<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

function db_driver(): string
{
    $driver = strtolower(trim((string) (env('DB_CONNECTION', 'mysql') ?? 'mysql')));

    return $driver === 'sqlite' ? 'sqlite' : 'mysql';
}

function db_name(): string
{
    return trim((string) (env('DB_NAME', env('DB_DATABASE', '')) ?? ''));
}

function db_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $driver = db_driver();

    if ($driver === 'mysql') {
        $host = env('DB_HOST', 'localhost') ?? 'localhost';
        $port = env('DB_PORT', '3306') ?? '3306';
        $database = db_name();
        $charset = env('DB_CHARSET', 'utf8mb4') ?? 'utf8mb4';

        if ($database === '') {
            throw new RuntimeException('MySQL connection requires DB_NAME to be set in .env.');
        }

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $database, $charset);
        $pdo = new PDO($dsn, env('DB_USER', '') ?? '', env('DB_PASS', '') ?? '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    }

    $databasePath = env('DB_DATABASE', __DIR__ . '/../storage/database.sqlite') ?? (__DIR__ . '/../storage/database.sqlite');
    $databaseDir = dirname($databasePath);

    if (!is_dir($databaseDir)) {
        mkdir($databaseDir, 0775, true);
    }

    if (!is_file($databasePath)) {
        touch($databasePath);
    }

    $pdo = new PDO('sqlite:' . $databasePath, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    return $pdo;
}

function migrate_database(): void
{
    static $migrated = false;

    if ($migrated) {
        return;
    }

    $pdo = db_connection();
    $driver = db_driver();

    if ($driver === 'mysql') {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS contact_messages (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  ip_address VARCHAR(45) DEFAULT NULL,
  user_agent TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
SQL;
    } else {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS contact_messages (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  category TEXT NOT NULL,
  message TEXT NOT NULL,
  ip_address TEXT DEFAULT NULL,
  user_agent TEXT DEFAULT NULL,
  created_at TEXT NOT NULL
)
SQL;
    }

    $pdo->exec($sql);
    $migrated = true;
}

function save_contact_message(array $payload): void
{
    migrate_database();

    $pdo = db_connection();
    $driver = db_driver();
    $parameters = [
        'name' => $payload['name'],
        'email' => $payload['email'],
        'category' => $payload['category'],
        'message' => $payload['message'],
        'ip_address' => $payload['ip_address'] ?? null,
        'user_agent' => $payload['user_agent'] ?? null,
    ];

    if ($driver === 'mysql') {
        $statement = $pdo->prepare(
            'INSERT INTO contact_messages (name, email, category, message, ip_address, user_agent) VALUES (:name, :email, :category, :message, :ip_address, :user_agent)'
        );
    } else {
        $statement = $pdo->prepare(
            'INSERT INTO contact_messages (name, email, category, message, ip_address, user_agent, created_at) VALUES (:name, :email, :category, :message, :ip_address, :user_agent, :created_at)'
        );
        $parameters['created_at'] = date(DATE_ATOM);
    }

    $statement->execute($parameters);
}
