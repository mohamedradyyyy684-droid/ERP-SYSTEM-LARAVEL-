<!DOCTYPE html>
<html lang="{{ str_replace(' ', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ERPPRO') }} - {{ tx('Business Management Suite') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">

    <!-- Bootstrap CSS (Local) -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons (Local) -->
    <link href="{{ asset('css/icons-local.css') }}" rel="stylesheet">

    
</head>
<body>
    <!-- Particles Background -->
    <div class="particles">
        @for($i = 0; $i < 30; $i++)
            <div class="particle"></div>
        @endfor
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Navigation -->
        <nav class="navbar-custom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="navbar-brand" href="/">
                        <div class="logo-icon">
                            <img src="{{ asset('favicon.jpg') }}" alt="ERPPRO">
                        </div>
                        <span>{{ tx('ERPPRO') }}</span>
                    </a>
                    <div class="d-flex align-items-center gap-3">
                        <a href="#features" class="nav-link-custom d-none d-md-inline">{{ tx('Features') }}</a>
                        <a href="#editions" class="nav-link-custom d-none d-md-inline">{{ tx('Editions') }}</a>
                        <a href="{{ route('login') }}" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="bi bi-rocket-takeoff"></i>
                    <span>{{ tx('Enterprise Resource Planning') }}</span>
                </div>
                <h1 class="hero-title">
                    Streamline Your <span>{{ tx('Business Operations') }}</span> with ERPPRO
                </h1>
                <p class="hero-subtitle">{{ tx('A comprehensive business management suite designed to help you manage finances, 
                    sales, purchases, inventory, and human resources - all in one powerful platform.
                ') }}</p>
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn-hero-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Get Started
                    </a>
                    <a href="#features" class="btn-hero-secondary">
                        <i class="bi bi-play-circle"></i>
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>{{ tx('Powerful Modules for Every Need') }}</h2>
                <p>{{ tx('Everything you need to run your business efficiently') }}</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon finance">
                        <i class="bi bi-coin"></i>
                    </div>
                    <h3>{{ tx('Finance & Accounting') }}</h3>
                    <p>{{ tx('Complete financial management with Chart of Accounts, Journal Vouchers, Bank Reconciliation, and comprehensive financial reports.') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon sales">
                        <i class="bi bi-cart3"></i>
                    </div>
                    <h3>{{ tx('Sales Management') }}</h3>
                    <p>{{ tx('Manage customers, quotations, sales orders, invoices, and returns with real-time tracking and analytics.') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon purchase">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3>{{ tx('Purchase Management') }}</h3>
                    <p>{{ tx('Handle suppliers, purchase orders, invoices, and returns. Track costs and maintain optimal inventory levels.') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon warehouse">
                        <i class="bi bi-building"></i>
                    </div>
                    <h3>{{ tx('Inventory & Warehouse') }}</h3>
                    <p>{{ tx('Multi-warehouse support, stock transfers, adjustments, receiving notes, and delivery management.') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon hr">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>{{ tx('Human Resources') }}</h3>
                    <p>{{ tx('Employee management, departments, positions, attendance, leave management, and payroll processing.') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon reports">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h3>{{ tx('Reports & Analytics') }}</h3>
                    <p>{{ tx('Balance Sheet, Income Statement, Trial Balance, and custom reports with export capabilities.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Editions Section -->
    <section class="editions-section" id="editions">
        <div class="container">
            <div class="section-title">
                <h2>{{ tx('Choose Your Edition') }}</h2>
                <p>{{ tx('Select the plan that best fits your business needs') }}</p>
            </div>
            <div class="editions-grid">
                <div class="edition-card standard">
                    <span class="edition-badge">{{ tx('ERPPRO S') }}</span>
                    <h3 class="edition-title">{{ tx('Standard') }}</h3>
                    <p class="edition-subtitle">{{ tx('Business Suite') }}</p>
                    <ul class="edition-features list-unstyled">
                        <li><i class="bi bi-check-lg"></i> Sales & Customers</li>
                        <li><i class="bi bi-check-lg"></i> Purchases & Suppliers</li>
                        <li><i class="bi bi-check-lg"></i> Inventory Management</li>
                        <li><i class="bi bi-check-lg"></i> Basic Accounting</li>
                        <li><i class="bi bi-check-lg"></i> Employee Directory</li>
                        <li><i class="bi bi-check-lg"></i> Standard Reports</li>
                    </ul>
                </div>
                <div class="edition-card advanced featured">
                    <span class="edition-badge">{{ tx('ERPPRO X') }}</span>
                    <h3 class="edition-title">{{ tx('Advanced') }}</h3>
                    <p class="edition-subtitle">{{ tx('Advanced Suite') }}</p>
                    <ul class="edition-features list-unstyled">
                        <li><i class="bi bi-check-lg"></i> Everything in Standard</li>
                        <li><i class="bi bi-check-lg"></i> Bank & Treasury Management</li>
                        <li><i class="bi bi-check-lg"></i> Asset Management</li>
                        <li><i class="bi bi-check-lg"></i> Payroll Processing</li>
                        <li><i class="bi bi-check-lg"></i> Auto Journal Vouchers</li>
                        <li><i class="bi bi-check-lg"></i> Advanced Analytics</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="footer-text">
                &copy; {{ date('Y') }} ERPPRO - Enterprise Resource Planning System. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS (Local) -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>




