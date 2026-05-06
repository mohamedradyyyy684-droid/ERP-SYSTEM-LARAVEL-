<?php
/**
 * ERP PRO X - Unified CLI Installer
 * Version: 2.0
 * 
 * This script provides a professional, step-by-step setup for the ERP system.
 * It handles environment configuration, database creation, and seeding.
 */

// --- ANSI Colors ---
define('CLR_RESET', "\033[0m");
define('CLR_BOLD', "\033[1m");
define('CLR_GREEN', "\033[32m");
define('CLR_BLUE', "\033[34m");
define('CLR_CYAN', "\033[36m");
define('CLR_YELLOW', "\033[33m");
define('CLR_RED', "\033[31m");

function info($msg) { echo CLR_BLUE . "ℹ " . CLR_RESET . $msg . "\n"; }
function success($msg) { echo CLR_GREEN . "✔ " . CLR_BOLD . $msg . CLR_RESET . "\n"; }
function warn($msg) { echo CLR_YELLOW . "⚠ " . $msg . CLR_RESET . "\n"; }
function error($msg) { echo CLR_RED . "✖ " . CLR_BOLD . $msg . CLR_RESET . "\n"; }
function step($num, $msg) { echo "\n" . CLR_CYAN . CLR_BOLD . "Step $num: " . CLR_RESET . CLR_BOLD . $msg . CLR_RESET . "\n"; }

echo CLR_BOLD . CLR_BLUE . "=================================================" . CLR_RESET . "\n";
echo CLR_BOLD . CLR_BLUE . "          ERP PRO X - Unified Installer          " . CLR_RESET . "\n";
echo CLR_BOLD . CLR_BLUE . "=================================================" . CLR_RESET . "\n\n";

// --- Step 1: Environment Check ---
step(1, "Checking Environment");

if (!file_exists('.env')) {
    if (file_exists('.env.example')) {
        copy('.env.example', '.env');
        success(".env file created from .env.example");
    } else {
        error(".env.example not found. Please create .env manually.");
        exit(1);
    }
} else {
    info(".env file already exists.");
}

// Check PHP extensions
$required_extensions = ['pdo_mysql', 'bcmath', 'gd', 'intl', 'mbstring', 'xml', 'openssl'];
foreach ($required_extensions as $ext) {
    if (!extension_loaded($ext)) {
        warn("PHP extension '$ext' is not loaded. Some features may not work.");
    }
}

// --- Step 2: Database Configuration ---
step(2, "Database Configuration");

// Load .env
$env = parse_ini_file('.env');
$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? '3306';
$user = $env['DB_USERNAME'] ?? 'root';
$pass = $env['DB_PASSWORD'] ?? '';
$db   = $env['DB_DATABASE'] ?? 'erppro';

echo "Current DB Settings:\n";
echo "  Host: $host:$port\n";
echo "  User: $user\n";
echo "  Database: $db\n\n";

echo "Do you want to change these settings? (y/N): ";
$handle = fopen("php://stdin", "r");
$line = trim(fgets($handle));

if (strtolower($line) === 'y') {
    echo "Enter Host [$host]: "; $host = trim(fgets($handle)) ?: $host;
    echo "Enter Port [$port]: "; $port = trim(fgets($handle)) ?: $port;
    echo "Enter User [$user]: "; $user = trim(fgets($handle)) ?: $user;
    echo "Enter Password: "; $pass = trim(fgets($handle));
    echo "Enter Database Name [$db]: "; $db = trim(fgets($handle)) ?: $db;

    // Update .env file
    $content = file_get_contents('.env');
    $content = preg_replace('/DB_HOST=.*/', "DB_HOST=$host", $content);
    $content = preg_replace('/DB_PORT=.*/', "DB_PORT=$port", $content);
    $content = preg_replace('/DB_USERNAME=.*/', "DB_USERNAME=$user", $content);
    $content = preg_replace('/DB_PASSWORD=.*/', "DB_PASSWORD=$pass", $content);
    $content = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE=$db", $content);
    file_put_contents('.env', $content);
    success(".env updated.");
}

// --- Step 3: Database Connection & Creation ---
step(3, "Establishing Connection");

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    success("Connected to MySQL server.");

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    success("Database '$db' verified/created.");
} catch (PDOException $e) {
    error("Connection failed: " . $e->getMessage());
    exit(1);
}

// --- Step 4: Run Migrations ---
step(4, "Running Migrations");
info("This might take a moment...");

exec('php artisan migrate:status 2>&1', $status_out);
if (strpos(implode("\n", $status_out), 'No migrations found') !== false) {
    warn("No migrations found in default path. Running unified migration path...");
    passthru('php artisan migrate --path=database/migrations/common --force');
} else {
    passthru('php artisan migrate --force');
}
success("Migrations completed.");

// --- Step 5: Seed Data ---
step(5, "Seeding Default Data");
passthru('php artisan db:seed --force');
success("Default data and settings seeded.");

// --- Step 6: Finalize ---
step(6, "Finalizing Setup");

passthru('php artisan key:generate');
passthru('php artisan storage:link');
passthru('php artisan cache:clear');
passthru('php artisan config:clear');

success("System finalized.");

echo "\n" . CLR_BOLD . CLR_GREEN . "=================================================" . CLR_RESET . "\n";
echo CLR_BOLD . CLR_GREEN . "         ERP PRO X INSTALLED SUCCESSFULLY!       " . CLR_RESET . "\n";
echo CLR_BOLD . CLR_GREEN . "=================================================" . CLR_RESET . "\n\n";

echo "Default Credentials:\n";
echo "  URL:      http://localhost\n";
echo "  Admin:    Admin@ERPPRO.Site\n";
echo "  Password: admin123\n\n";

echo "Action Items:\n";
echo "  1. Open your browser and navigate to the URL above.\n";
echo "  2. Use the " . CLR_BOLD . "keygen.py" . CLR_RESET . " tool in 'tools/keygen' to generate your license key.\n";
echo "  3. Log in and change your default password immediately.\n\n";

echo "🚀 Happy ERPing!\n";
fclose($handle);
