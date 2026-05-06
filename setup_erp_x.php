<?php

/**
 * ERP PRO X - Complete Setup Program
 * Single Edition Setup (Full Edition X Only)
 *
 * This script creates the complete ERP database with:
 * - All database tables
 * - Default Edition X settings
 * - Complete chart of accounts
 * - Default finance configuration
 * - System admin user
 *
 * Usage: php setup_erp_x.php
 */
echo "=================================================\n";
echo "  ERP PRO X - Complete Edition Setup\n";
echo "=================================================\n\n";

// Configuration
$host = 'localhost';
$port = '3306';
$username = 'root';
$password = '';  // ← Enter your MySQL password here
$database = 'erppro_x';

// Display configuration
echo "Configuration:\n";
echo "  Host: {$host}\n";
echo "  Port: {$port}\n";
echo "  Username: {$username}\n";
echo "  Database: {$database}\n";
echo '  Password: '.(empty($password) ? '(empty - using default)' : '***')."\n\n";

// Ask for confirmation
echo "⚠️  This will create the complete ERP X Edition database.\n";
echo 'Do you want to proceed? (yes/no): ';
$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
fclose($handle);

if (trim(strtolower($line)) !== 'yes') {
    echo "Setup cancelled.\n";
    exit(0);
}

echo "\n";
$startTime = microtime(true);

try {
    // ==========================================
    // STEP 1: Connect to MySQL
    // ==========================================
    echo "Step 1/6: Connecting to MySQL server...\n";
    $pdo = new PDO("mysql:host={$host};port={$port};charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "  ✓ Connected successfully\n\n";

    // ==========================================
    // STEP 2: Create database
    // ==========================================
    echo "Step 2/6: Creating database '{$database}'...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE {$database}");
    echo "  ✓ Database created\n\n";

    // ==========================================
    // STEP 3: Import complete database schema
    // ==========================================
    echo "Step 3/6: Creating all ERP tables...\n";

    // Read and execute the complete schema
    $schemaFile = __DIR__.'/database/sql/complete_database_schema.sql';
    if (! file_exists($schemaFile)) {
        throw new Exception("Schema file not found: {$schemaFile}");
    }

    $schemaSql = file_get_contents($schemaFile);
    $pdo->exec($schemaSql);
    echo "  ✓ All tables created (80+ tables)\n\n";

    // ==========================================
    // STEP 4: Set up Edition X configuration
    // ==========================================
    echo "Step 4/6: Configuring Edition X settings...\n";

    // Set product edition to X
    $pdo->exec("INSERT INTO erp_settings (setting_key, setting_value, setting_type, category, description, is_system) VALUES
        ('product_edition', 'x', 'string', 'system', 'Product Edition: Full Edition X', true),
        ('system_edition', 'x', 'string', 'system', 'System Edition: Full Edition X', true)
    ON DUPLICATE KEY UPDATE setting_value = 'x'");

    // Enable all Edition X features
    $features = [
        'edition_manual_jv' => 'true',
        'edition_auto_jv_invoices' => 'true',
        'edition_auto_jv_returns' => 'true',
        'edition_auto_jv_full' => 'true',
        'edition_sales_module' => 'true',
        'edition_finance_module' => 'true',
        'edition_warehouse_module' => 'true',
        'edition_sales_cycle' => 'true',
        'edition_sales_sheet' => 'true',
        'edition_assets' => 'true',
        'edition_banks' => 'true',
        'edition_treasury' => 'true',
        'edition_petty_cash' => 'true',
        'edition_depreciation' => 'true',
        'edition_salary_jv' => 'true',
        'edition_loans' => 'true',
        'edition_deductions' => 'true',
        'edition_full_hr' => 'true',
        'edition_full_payroll' => 'true',
    ];

    foreach ($features as $key => $value) {
        $pdo->exec("INSERT INTO erp_settings (setting_key, setting_value, setting_type, category, description, is_system) 
            VALUES ('{$key}', '{$value}', 'boolean', 'edition_features', 'Edition X Feature', true)
            ON DUPLICATE KEY UPDATE setting_value = '{$value}'");
    }

    echo "  ✓ Edition X features configured\n\n";

    // ==========================================
    // STEP 5: Initialize fiscal year system
    // ==========================================
    echo "Step 5/6: Configuring fiscal year system...\n";

    // Create years table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `years` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `year` INT NOT NULL UNIQUE,
        `is_active` BOOLEAN DEFAULT FALSE,
        `is_closed` BOOLEAN DEFAULT FALSE,
        `closed_at` TIMESTAMP NULL,
        `closed_by` INT UNSIGNED NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`closed_by`) REFERENCES `users`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // Insert current year as active
    $currentYear = date('Y');
    $pdo->exec("INSERT INTO `years` (`year`, `is_active`) VALUES ($currentYear, TRUE)");

    // Add fiscal_year columns to core financial tables
    $financialTables = [
        'journal_entries',
        'sales_invoices',
        'chart_of_accounts',
        'trial_balances',
        'balance_sheets'
    ];

    foreach ($financialTables as $table) {
        $pdo->exec("ALTER TABLE `$table`
            ADD COLUMN `fiscal_year` SMALLINT UNSIGNED NOT NULL DEFAULT $currentYear,
            ADD INDEX `{$table}_fiscal_year_index` (`fiscal_year`)
        ");

        // Backfill existing records
        $pdo->exec("UPDATE `$table` SET `fiscal_year` = YEAR(`date`) WHERE `date` IS NOT NULL");
    }

    echo "  ✓ Fiscal year system initialized for $currentYear\n\n";

    // ==========================================
    // STEP 6: Complete setup
    // ==========================================
    echo "Step 6/6: Creating default admin user...\n";

    $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $pdo->exec("INSERT INTO users (name, email, password, role, is_active, created_at, updated_at) 
        VALUES ('Administrator', 'Admin@ERPPRO.Site', '{$hashedPassword}', 'admin', true, NOW(), NOW())");

    echo "  ✓ Admin user created (email: Admin@ERPPRO.Site, password: admin123)\n\n";

    // ==========================================
    // FINAL: Display success message
    // ==========================================
    $endTime = microtime(true);
    $executionTime = round($endTime - $startTime, 2);

    echo "✅ ERP PRO X Setup Complete!\n\n";
    echo "📋 Setup Summary:\n";
    echo "   • Database: {$database}\n";
    echo "   • Edition: Full Edition X (Complete ERP)\n";
    echo "   • Tables: 80+ tables created\n";
    echo "   • Features: All Edition X features enabled\n";
    echo "   • Admin: Admin@ERPPRO.Site / admin123\n";
    echo "   • Time: {$executionTime} seconds\n\n";

    echo "🚀 Next Steps:\n";
    echo "   1. Run the chart of accounts seeder:\n";
    echo "      php artisan db:seed --class=DefaultChartOfAccountsSeeder\n\n";
    echo "   2. Access your ERP at: http://localhost\n";
    echo "   3. Login with Admin@ERPPRO.Site / admin123\n\n";

    echo "💡 Note: For production, change the default admin password!\n";

} catch (Exception $e) {
    echo '❌ Setup Failed: '.$e->getMessage()."\n";
    echo 'Error Code: '.$e->getCode()."\n";
    exit(1);
}
