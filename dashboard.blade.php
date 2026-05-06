{{-- Localized strings are resolved through tx() from root JSON files in lang/*.json and lang/{locale}_*.json. --}}
@extends('layouts.app')

@section('title', tx('dashboard_ui.main_title'))

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <x-ui.page-header title="{{ tx('dashboard_ui.main_title') }}" subtitle="{{ tx('dashboard_ui.main_subtitle') }}">
        <x-slot name="actions">
            <x-ui.button color="primary" href="/reports/new">{{ tx('dashboard_ui.new_report') }}</x-ui.button>
            <x-ui.button color="secondary" outline>{{ tx('dashboard_ui.export_data') }}</x-ui.button>
        </x-slot>
    </x-ui.page-header>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <x-ui.card class="shadow-sm border-left-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ tx('dashboard_ui.total_sales') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                $124,567
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <div class="col-md-3">
            <x-ui.card class="shadow-sm border-left-success">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ tx('dashboard_ui.new_customers') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                1,245
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <div class="col-md-3">
            <x-ui.card class="shadow-sm border-left-info">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ tx('dashboard_ui.pending_orders') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                34
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <div class="col-md-3">
            <x-ui.card class="shadow-sm border-left-warning">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ tx('dashboard_ui.inventory_alert') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                8
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ tx('dashboard_ui.recent_transactions') }}</h5>
                        <a href="/finance/journal-vouchers" class="small text-muted">{{ tx('dashboard_ui.view_all') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>{{ tx('dashboard_ui.date') }}</th>
                                    <th>{{ tx('dashboard_ui.description') }}</th>
                                    <th>{{ tx('dashboard_ui.amount') }}</th>
                                    <th>{{ tx('dashboard_ui.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">{{ tx('dashboard_ui.no_recent_transactions') }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ tx('dashboard_ui.quick_actions') }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('finance.journal-vouchers.index', ['tab' => 'create']) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-invoice me-2"></i>{{ tx('dashboard_ui.create_journal_entry') }}
                        </a>
                        <a href="{{ route('purchases.purchase-orders.index', ['tab' => 'create']) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-shopping-cart me-2"></i>{{ tx('dashboard_ui.new_purchase_order') }}
                        </a>
                        <a href="{{ route('warehouse.inventory.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-boxes me-2"></i>{{ tx('dashboard_ui.manage_inventory') }}
                        </a>
                        <a href="{{ route('sales.customers.index', ['tab' => 'create']) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-plus me-2"></i>{{ tx('dashboard_ui.add_customer') }}
                        </a>
                        <a href="{{ route('finance.statements.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-chart-bar me-2"></i>{{ tx('dashboard_ui.view_reports') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const transactionHeaders = {!! json_encode([
        ['label' => tx('dashboard_ui.date'), 'field' => 'date'],
        ['label' => tx('dashboard_ui.customer'), 'field' => 'customer'],
        ['label' => tx('dashboard_ui.amount'), 'field' => 'amount'],
        ['label' => tx('dashboard_ui.status'), 'field' => 'status'],
    ]) !!};

    const recentTransactions = [
        { date: '2026-04-28', customer: 'Acme Corp', amount: '$1,250.00', status: 'completed' },
        { date: '2026-04-27', customer: 'Beta LLC', amount: '$750.00', status: 'pending' },
        { date: '2026-04-26', customer: 'Gamma Inc', amount: '$2,100.00', status: 'completed' },
        { date: '2026-04-25', customer: 'Delta Solutions', amount: '$980.00', status: 'completed' }
    ];
</script>
@endpush

