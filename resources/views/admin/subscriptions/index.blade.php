@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- بطاقات الإحصائيات -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            إجمالي الاشتراكات</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            اشتراكات نشطة</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            اشتراكات تنتهي قريباً</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['expiring'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            اشتراكات جديدة اليوم</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['new_today'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">إدارة الاشتراكات</h6>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addSubscriptionModal">
                            <i class="fas fa-plus"></i> إضافة اشتراك جديد
                        </button>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>المستخدم</th>
                                        <th>الباقة</th>
                                        <th>تاريخ البدء</th>
                                        <th>تاريخ الانتهاء</th>
                                        <th>قفل الوجبات (ساعة)</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->id }}</td>
                                            <td>{{ $subscription->user->name }}</td>
                                            <td>{{ $subscription->package->name }}</td>
                                            <td>{{ $subscription?->start_date?->format('Y-m-d') }}</td>
                                            <td>{{ $subscription->start_date->addDays($subscription->package->days_count)->format('Y-m-d') }}
                                            </td>
                                            <td>{{ $subscription->meal_lock_hours }}</td>
                                            <td>
                                                @if ($subscription->start_date->addDays($subscription->package->days_count)->isFuture())
                                                    <span class="badge badge-success">نشط</span>
                                                @else
                                                    <span class="badge badge-secondary">منتهي</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editSubscriptionModal{{ $subscription->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteSubscriptionModal{{ $subscription->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editSubscriptionModal{{ $subscription->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="editSubscriptionModalLabel{{ $subscription->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="editSubscriptionModalLabel{{ $subscription->id }}">
                                                            تعديل اشتراك #{{ $subscription->id }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-white">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('subscriptions.update', $subscription->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="user_id">المستخدم</label>
                                                                        <select class="form-control select2" id="user_id"
                                                                            name="user_id" required>
                                                                            @foreach (App\Models\User::all() as $user)
                                                                                <option value="{{ $user->id }}"
                                                                                    {{ $subscription->user_id == $user->id ? 'selected' : '' }}>
                                                                                    {{ $user->name }} -
                                                                                    {{ $user->phone }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="package_id">الباقة</label>
                                                                        <select class="form-control select2"
                                                                            id="package_id" name="package_id" required>
                                                                            @foreach (App\Models\Package::all() as $package)
                                                                                <option value="{{ $package->id }}"
                                                                                    {{ $subscription->package_id == $package->id ? 'selected' : '' }}>
                                                                                    {{ $package->name }}
                                                                                    ({{ $package->days_count }} يوم)
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="start_date">تاريخ البدء</label>
                                                                        <input type="date" class="form-control"
                                                                            id="start_date" name="start_date"
                                                                            value="{{ $subscription->start_date->format('Y-m-d') }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="meal_lock_hours">ساعات قفل
                                                                            الوجبات</label>
                                                                        <input type="number" class="form-control"
                                                                            id="meal_lock_hours" name="meal_lock_hours"
                                                                            value="{{ $subscription->meal_lock_hours }}"
                                                                            min="1" max="72" required>
                                                                        <small class="text-muted">عدد الساعات المطلوبة قبل
                                                                            تعديل الوجبات</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">إغلاق</button>
                                                            <button type="submit" class="btn btn-primary">حفظ
                                                                التغييرات</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteSubscriptionModal{{ $subscription->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deleteSubscriptionModalLabel{{ $subscription->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title"
                                                            id="deleteSubscriptionModalLabel{{ $subscription->id }}">
                                                            تأكيد الحذف
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-white">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من رغبتك في حذف الاشتراك التالي؟</p>
                                                        <div class="alert alert-warning">
                                                            <strong>المستخدم:</strong> {{ $subscription->user->name }}<br>
                                                            <strong>الباقة:</strong> {{ $subscription->package->name }}<br>
                                                            <strong>الفترة:</strong> من
                                                            {{ $subscription->start_date->format('Y-m-d') }} إلى
                                                            {{ $subscription->start_date->addDays($subscription->package->days_count)->format('Y-m-d') }}
                                                        </div>
                                                        <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <form
                                                            action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">حذف
                                                                الاشتراك</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Subscription Modal -->
    <div class="modal fade" id="addSubscriptionModal" tabindex="-1" role="dialog"
        aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addSubscriptionModalLabel">إضافة اشتراك جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">المستخدم *</label>
                                    <select class="form-control select2" id="user_id" name="user_id" required>
                                        <option value="">اختر المستخدم</option>
                                        @foreach (App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} - {{ $user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_id">الباقة *</label>
                                    <select class="form-control select2" id="package_id" name="package_id" required>
                                        <option value="">اختر الباقة</option>
                                        @foreach (App\Models\Package::all() as $package)
                                            <option value="{{ $package->id }}">
                                                {{ $package->name }} ({{ $package->days_count }} يوم)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">تاريخ البدء *</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ now()->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meal_lock_hours">ساعات قفل الوجبات *</label>
                                    <input type="number" class="form-control" id="meal_lock_hours"
                                        name="meal_lock_hours" value="24" min="1" max="72" required>
                                    <small class="text-muted">عدد الساعات المطلوبة قبل تعديل الوجبات</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ الاشتراك</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .modal-header {
            border-radius: 0;
        }

        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
        }
    </style>
@endsection
