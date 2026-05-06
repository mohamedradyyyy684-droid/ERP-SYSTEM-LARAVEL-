# Database Schema Overview

## Departments Table
- **Description**: Stores information about various departments within the organization.
- **Key Fields**:
  - `id`: Unique identifier for each department.
  - `name`: Name of the department.
  - `description`: Brief description of the department's responsibilities.

## Statements Table
- **Description**: Contains financial statements and reports.
- **Key Fields**:
  - `id`: Unique identifier for each statement.
  - `type`: Type of statement (e.g., Balance Sheet, Income Statement).
  - `date`: Date of the statement.
  - `data`: JSON field containing detailed financial data.

## Inventory Table
- **Description**: Tracks inventory items and their quantities.
- **Key Fields**:
  - `id`: Unique identifier for each inventory item.
  - `product_id`: Reference to the product in the products table.
  - `quantity`: Current stock quantity.
  - `location`: Storage location within the warehouse.

## Running Migrations
- **Command**:
  ```bash
  php artisan migrate
  ```

## Running Seeders
- **Command**:
  ```bash
  php artisan db:seed
  ```

## Default Seeders
- **Description**: Seeders are used to populate the database with default data.
- **Key Seeder: Chart of Accounts**
  - **Purpose**: Provides a comprehensive tree structure for trading activities.
  - **Transactions Covered**:
    - Invoices
    - Purchase Invoices
    - Tax
    - Discounts
    - Returns

## Chart of Accounts Tree Structure
- **Assets**
  - Current Assets
    - Cash
    - Accounts Receivable
    - Inventory
- **Liabilities**
  - Current Liabilities
    - Accounts Payable
    - Taxes Payable
- **Equity**
  - Retained Earnings
- **Revenue**
  - Sales Revenue
- **Expenses**
  - Cost of Goods Sold
  - Operating Expenses

## Admin User Creation
- **Steps**:
  1. Run the following command to create an admin user:
     ```bash
     php artisan make:admin
     ```
  2. Follow the prompts to enter the admin user details.
  3. Verify the creation by logging into the system with the provided credentials.

## Inventory Methods Configuration
- **Periodic Inventory**:
  - **File**: `config/periodic_inventory.php`
  - **Description**: Handles periodic inventory calculations.

- **Perpetual Inventory**:
  - **File**: `config/perpetual_inventory.php`
  - **Description**: Handles perpetual inventory calculations.

- **FIFO Inventory Valuation**:
  - **File**: `config/fifo_inventory.php`
  - **Description**: First In, First Out inventory valuation method.

- **AVG Inventory Valuation**:
  - **File**: `config/avg_inventory.php`
  - **Description**: Average inventory valuation method.
