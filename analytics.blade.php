@extends('layouts.app')

@section('title',   ('Analytics'))
@section('page-title',   ('Analytics'))
@section('page-subtitle',   ('Business performance overview'))

@section('content')
<div class="container-fluid">
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('Revenue Growth') }}</div>
                    <div class="fs-4 fw-bold">{{ number format($analytics['revenue growth'] ?? 0, 1) }}%</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('New Customers') }}</div>
                    <div class="fs-4 fw-bold">{{ number format($analytics['new customers'] ?? 0) }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('Average Order Value') }}</div>
                    <div class="fs-4 fw-bold">{{ number format($analytics['avg order value'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('Profit Margin') }}</div>
                    <div class="fs-4 fw-bold">{{ number format($analytics['profit margin'] ?? 0, 1) }}%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('Gross Revenue') }}</div>
                    <div class="fw-bold">{{ number format($analytics['gross revenue'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('COGS') }}</div>
                    <div class="fw-bold">{{ number format($analytics['cogs'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ tx('Net Profit') }}</div>
                    <div class="fw-bold">{{ number format($analytics['net profit'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0">{{ tx('Top Customers') }}</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ tx('Name') }}</th>
                                    <th class="text-end">{{ tx('Orders') }}</th>
                                    <th class="text-end">{{ tx('Revenue') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($analytics['top customers'] ?? []) as $customer)
                                    <tr>
                                        <td>{{ $customer->name ?? '-' }}</td>
                                        <td class="text-end">{{ number format($customer->orders ?? 0) }}</td>
                                        <td class="text-end">{{ number format($customer->revenue ?? 0, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">{{ tx('No data') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0">{{ tx('Top Products') }}</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ tx('Name') }}</th>
                                    <th class="text-end">{{ tx('Units') }}</th>
                                    <th class="text-end">{{ tx('Revenue') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($analytics['top products'] ?? []) as $product)
                                    <tr>
                                        <td>{{ $product->name ?? '-' }}</td>
                                        <td class="text-end">{{ number format($product->units ?? 0) }}</td>
                                        <td class="text-end">{{ number format($product->revenue ?? 0, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">{{ tx('No data') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




