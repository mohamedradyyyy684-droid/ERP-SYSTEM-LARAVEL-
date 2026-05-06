# ERP System Testing Setup Guide

This guide provides a step-by-step process to set up and test the ERP system.

## Prerequisites

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js 18 or higher
- Git

## Step 1: Environment Setup

1. Clone or copy the project files to your local machine
2. Navigate to the project directory: `cd e:\erpprox3\erpx3`
3. Install PHP dependencies: `composer install`
4. Install Node.js dependencies: `npm install`

## Step 2: Database Setup

### Option A: Using the Fixed Setup Script (Recommended)

1. Run the fixed database setup script:
   ```
   php database/setup_database_fixed.php
   ```

2. Follow the prompts to confirm database creation

### Option B: Manual Setup

1. Create a database in your MySQL server:
   ```sql
   CREATE DATABASE erppro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Update your `.env` file with database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=erppro
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Run Laravel migrations:
   ```
   php artisan migrate --force
   ```

4. Seed the database:
   ```
   php artisan db:seed
   ```

## Step 3: Storage Link

Create a symbolic link for storage:
```
php artisan storage:link
```

## Step 4: Application Configuration

1. Generate application key:
   ```
   php artisan key:generate
   ```

2. Clear caches:
   ```
   php artisan config:clear
   php artisan cache:clear
   ```

## Step 5: Testing the System

### 5.1 Basic System Tests

1. Start the development server:
   ```
   php artisan serve
   ```

2. Visit `http://127.0.0.1:8000` in your browser

3. Test basic functionality:
   - Login with default credentials (if available)
   - Check if dashboard loads without errors
   - Verify multi-language toggle functionality

### 5.2 Module-Specific Tests

#### Finance Module
1. Navigate to Finance > Chart of Accounts
2. Verify accounts are loaded
3. Test creating a Journal Voucher
4. Verify auto-JV functionality

#### Sales Module
1. Navigate to Sales > Customers
2. Create a new customer
3. Create a sales invoice
4. Verify auto-JV creation

#### HR Module
1. Navigate to HR > Employees
2. Create a new employee
3. Navigate to HR > Salaries
4. Create a salary contract and approve it
5. Verify the auto-JV creation for salary approval
6. Process payroll and mark as paid
7. Verify the payment JV creation

#### Purchase Module
1. Navigate to Purchases > Suppliers
2. Create a new supplier
3. Create a purchase invoice
4. Verify auto-JV creation

## Step 6: Verification Checklist

- [ ] Database connected successfully
- [ ] All migrations completed
- [ ] Application loads without errors
- [ ] Multi-language toggle works
- [ ] Finance module functions correctly
- [ ] Sales module functions correctly
- [ ] HR module functions correctly
- [ ] Purchase module functions correctly
- [ ] Auto-JV functionality works across all modules
- [ ] Reports generate correctly
- [ ] Export functionality works (Customer, Item, Employee, Supplier)

## Troubleshooting

### Common Issues

1. **Database Connection Errors**
   - Verify MySQL server is running
   - Check credentials in `.env` file
   - Ensure user has proper permissions

2. **Migration Failures**
   - Run `php artisan migrate:status` to check status
   - Check if tables already exist
   - Clear configuration cache with `php artisan config:clear`

3. **Missing Dependencies**
   - Run `composer install` again
   - Check PHP version requirements
   - Verify required extensions are installed

4. **Storage Link Issues**
   - Run `php artisan storage:link` again
   - Check folder permissions

### Error Logs

Check the logs at `storage/logs/laravel.log` for detailed error information.

## Additional Resources

- [API Documentation](./docs/api/)
- [User Manual](./docs/user-manual/)
- [Admin Guide](./docs/admin-guide/)
# ERP System Setup Guide

Follow these steps to complete the ERP system setup:

## Step 1: Initial Database Setup & Serial Activation/Trial

1. **Run Migrations First**
   ```bash
   php artisan migrate
   ```
   This will create all necessary tables including your newly created department accounts tables.

2. **Check Database Connection**
   Ensure your `.env` file has correct database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

3. **Serial Activation or 7-Day Trial**
   - Access the installation wizard at: `http://your-domain.com/install`
   - Enter your serial key for full activation OR
   - Choose the 7-day trial option
   - The system will validate your choice and proceed

## Step 2: Database Configuration & Migration (2nd Page)

1. **Database Name & Connection Test**
   - In the installation wizard, specify your database name
   - Click "Test Connection" to verify communication
   - If successful, proceed to migration

2. **Run Migrations**
   - The system will automatically run:
     ```bash
     php artisan migrate --force
     ```
   - This includes your department account tables:
     - sales_accounts
     - hr_accounts
     - finance_accounts
     - inventory_accounts
     - procurement_accounts

## Step 3: Company Information Setup (3rd Page)

1. **Enter Full Company Details**
   - Company Name (English/Arabic)
   - Email Address
   - Currency (SAR, USD, EUR, etc.)
   - Phone Number
   - Address
   - Tax Information
   - Logo Upload

2. **Save Company Info**
   - The system validates and stores company data
   - Sets company as active in the database

## Step 4: Administrator Setup & Initial Seeding (4th Page)

1. **Create Administrator Account**
   - Full Name
   - Email (used for login)
   - Password (secure, minimum 8 characters)
   - Confirm Password
   - Role: Administrator (pre-selected)

2. **Run Essential Seeders**
   The system automatically executes:
   ```bash
   php artisan db:seed --class=CompanyAndYearSeeder
   php artisan db:seed --class=AdminUserSeeder
   php artisan db:seed --class=ChartOfAccountsSeeder
   ```

3. **Additional Seeder Execution**
   - Settings seeder
   - Default data seeder
   - Chart of Accounts tree seeder

## Step 5: Settings & Chart of Accounts Setup

1. **System Settings Configuration**
   - Fiscal Year Settings
   - Accounting Preferences
   - Tax Configuration
   - Notification Settings
   - Backup Settings

2. **Default Chart of Accounts**
   - The system seeds a complete COA structure
   - Includes assets, liabilities, equity, revenue, expense accounts
   - Hierarchical tree structure ready for use

## Step 6: Finalization & Access

1. **Setup Completion**
   - System marks setup as completed in `erp_settings` table
   - Welcome page becomes accessible
   - Installation wizard locks to prevent reconfiguration

2. **Login to System**
   - Navigate to: `http://your-domain.com/login`
   - Use administrator credentials created in Step 4
   - Password: the one you set (default was 'admin123' if using seeder directly)

3. **First-Time Login Experience**
   - Welcome/dashboard overview
   - Quick start guide
   - System tour (optional)
   - Ready to use ERP modules

## Important Notes & Advice

### Troubleshooting Tips:
- If migrations fail: Check database user permissions
- If seeders fail: Ensure all migration tables exist first
- If login fails: Verify AdminUserSeeder ran correctly
- For connection issues: Check .env and firewall settings

### Security Recommendations:
1. Change administrator password after first login
2. Enable HTTPS in production
3. Set up regular database backups
4. Review user roles and permissions
5. Update system regularly

### Directory Structure Note:
Your newly created department account migrations are located at:
`database/migrations/` with timestamps:
- 2026_04_26_000004_create_sales_accounts_table.php
- 2026_04_26_000005_create_hr_accounts_table.php
- 2026_04_26_000006_create_finance_accounts_table.php
- 2026_04_26_000007_create_inventory_accounts_table.php
- 2026_04_26_000008_create_procurement_accounts_table.php

### Available Seeders Reference:
Key seeders used in setup:
- `CompanyAndYearSeeder` - Creates company and fiscal year
- `AdminUserSeeder` - Creates administrator account
- `ChartOfAccountsSeeder` - Sets up accounting structure
- `DefaultSettingsSeeder` - Configures system settings
- Various data seeders for modules (optional)

## Completion
Once these steps are completed, your ERP system is fully installed and ready for use with all department account tables properly configured.