@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center bg-gradient-primary">
                        <h5 class="mb-0 text-white">
                            <i class="fas fa-utensils me-2"></i> نظام تتبع طلبات الوجبات
                        </h5>
                        <button class="btn btn-light mb-0" data-bs-toggle="modal" data-bs-target="#createOrderModal">
                            <i class="fas fa-plus me-1"></i> طلب جديد
                        </button>
                    </div>

                    <!-- إحصائيات الطلبات -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-success shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">الطلبات المكتملة</div>
                                                <div class="h4">{{ $stats['completed'] }}</div>
                                                <div class="progress mt-2" style="height: 4px;">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $stats['completed_percent'] }}%"></div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-info shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info mb-1">الطلبات قيد الانتظار</div>
                                                <div class="h4">{{ $stats['pending'] }}</div>
                                                <div class="progress mt-2" style="height: 4px;">
                                                    <div class="progress-bar bg-info"
                                                        style="width: {{ $stats['pending_percent'] }}%"></div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-clock fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-warning shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-warning mb-1">الطلبات قيد التجهيز</div>
                                                <div class="h4">{{ $stats['processing'] }}</div>
                                                <div class="progress mt-2" style="height: 4px;">
                                                    <div class="progress-bar bg-warning"
                                                        style="width: {{ $stats['processing_percent'] }}%"></div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-spinner fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-danger shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-danger mb-1">الطلبات المرفوضة</div>
                                                <div class="h4">{{ $stats['rejected'] }}</div>
                                                <div class="progress mt-2" style="height: 4px;">
                                                    <div class="progress-bar bg-danger"
                                                        style="width: {{ $stats['rejected_percent'] }}%"></div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- رسم بياني -->
                        <div class="card shadow mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-chart-line me-1"></i> توزيع الطلبات خلال الأسبوع
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="ordersChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- ألسنة التبويب -->
                        <ul class="nav nav-tabs mb-4" id="ordersTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                                    type="button">
                                    <i class="fas fa-list me-1"></i> الكل ({{ $orders->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                                    type="button">
                                    <i class="fas fa-clock me-1"></i> قيد الانتظار
                                    ({{ $orders->where('status', 'pending')->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="processing-tab" data-bs-toggle="tab"
                                    data-bs-target="#processing" type="button">
                                    <i class="fas fa-spinner me-1"></i> قيد التجهيز
                                    ({{ $orders->where('status', 'processing')->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                    data-bs-target="#completed" type="button">
                                    <i class="fas fa-check-circle me-1"></i> مكتملة
                                    ({{ $orders->where('status', 'completed')->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab"
                                    data-bs-target="#rejected" type="button">
                                    <i class="fas fa-times-circle me-1"></i> مرفوضة
                                    ({{ $orders->where('status', 'rejected')->count() }})
                                </button>
                            </li>
                        </ul>

                        <!-- محتوى التبويبات -->
                        <div class="tab-content" id="ordersTabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                @include('admin.orders.orders_table', ['orders' => $orders])
                            </div>
                            <div class="tab-pane fade" id="pending" role="tabpanel">
                                @include('admin.orders.orders_table', [
                                    'orders' => $orders->where('status', 'pending'),
                                ])
                            </div>
                            <div class="tab-pane fade" id="processing" role="tabpanel">
                                @include('admin.orders.orders_table', [
                                    'orders' => $orders->where('status', 'processing'),
                                ])
                            </div>
                            <div class="tab-pane fade" id="completed" role="tabpanel">
                                @include('admin.orders.orders_table', [
                                    'orders' => $orders->where('status', 'completed'),
                                ])
                            </div>
                            <div class="tab-pane fade" id="rejected" role="tabpanel">
                                @include('admin.orders.orders_table', [
                                    'orders' => $orders->where('status', 'rejected'),
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('orders.modals.create')
    @foreach ($orders as $order)
        @include('orders.modals.edit', ['order' => $order])
        @include('orders.modals.status', ['order' => $order])
    @endforeach --}}
@endsection

@push('styles')
    <style>
        .order-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-card.pending {
            border-left-color: #17a2b8;
        }

        .order-card.processing {
            border-left-color: #ffc107;
        }

        .order-card.completed {
            border-left-color: #28a745;
        }

        .order-card.rejected {
            border-left-color: #dc3545;
        }

        .meal-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
        }

        .order-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // الرسم البياني
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                datasets: [{
                    label: 'طلبات مكتملة',
                    data: [12, 19, 15, 17, 14, 8, 10],
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }, {
                    label: 'طلبات مرفوضة',
                    data: [2, 3, 1, 4, 2, 1, 3],
                    backgroundColor: 'rgba(220, 53, 69, 0.7)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        rtl: true
                    },
                    tooltip: {
                        rtl: true
                    }
                }
            }
        });

        // حفظ التبويب النشط
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('activeOrderTab', e.target.id);
        });

        const activeTab = localStorage.getItem('activeOrderTab');
        if (activeTab) {
            const tab = new bootstrap.Tab(document.getElementById(activeTab));
            tab.show();
        }

        // معاينة الصورة
        document.getElementById('mealImage')?.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const previewImg = preview.querySelector('img');

            if (e.target.files.length > 0) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(e.target.files[0]);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endpush
