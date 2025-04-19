@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- إحصائيات -->
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-right-primary shadow h-100 py-2">
                            <div class="card-body text-right">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            إجمالي الوجبات</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-right-success shadow h-100 py-2">
                            <div class="card-body text-right">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-sun fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            وجبات الفطور</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['breakfast'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-right-info shadow h-100 py-2">
                            <div class="card-body text-right">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-utensils fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">وجبات الغداء
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['lunch'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-right-warning shadow h-100 py-2">
                            <div class="card-body text-right">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-moon fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            وجبات العشاء</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['dinner'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- المحتوى الرئيسي -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">باقات الوجبات</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                            <i class="fas fa-plus"></i> إضافة جديد
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>الوجبة</th>
                                        <th>الباقة</th>
                                        <th>النوع</th>
                                        <th>التاريخ</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mealPackages as $mealPackage)
                                        <tr>
                                            <td>{{ $mealPackage->meal->name }}</td>
                                            <td>{{ $mealPackage->package->name }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $mealPackage->type == 'breakfast'
                                                        ? 'primary'
                                                        : ($mealPackage->type == 'lunch'
                                                            ? 'success'
                                                            : ($mealPackage->type == 'dinner'
                                                                ? 'warning'
                                                                : 'info')) }}">
                                                    @if ($mealPackage->type == 'breakfast')
                                                        فطور
                                                    @elseif($mealPackage->type == 'lunch')
                                                        غداء
                                                    @elseif($mealPackage->type == 'dinner')
                                                        عشاء
                                                    @else
                                                        وجبة خفيفة
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $mealPackage->date ? $mealPackage->date->format('Y-m-d') : 'غير محدد' }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editModal" data-id="{{ $mealPackage->id }}"
                                                    data-meal-id="{{ $mealPackage->meal_id }}"
                                                    data-package-id="{{ $mealPackage->package_id }}"
                                                    data-type="{{ $mealPackage->type }}"
                                                    data-date="{{ $mealPackage->date }}">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </button>
                                                <form action="{{ route('meal-packages.destroy', $mealPackage->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('هل أنت متأكد؟')">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أحدث الإضافات -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">أحدث الإضافات</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($stats['latest'] as $latest)
                                <div
                                    class="list-group-item list-group-item-action flex-column align-items-start mb-2 text-right">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $latest->meal->name }} مع {{ $latest->package->name }}</h6>
                                        <small>{{ $latest->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">
                                        <span
                                            class="badge badge-{{ $latest->type == 'breakfast'
                                                ? 'primary'
                                                : ($latest->type == 'lunch'
                                                    ? 'success'
                                                    : ($latest->type == 'dinner'
                                                        ? 'warning'
                                                        : 'info')) }}">
                                            @if ($latest->type == 'breakfast')
                                                فطور
                                            @elseif($latest->type == 'lunch')
                                                غداء
                                            @elseif($latest->type == 'dinner')
                                                عشاء
                                            @else
                                                وجبة خفيفة
                                            @endif
                                        </span>
                                        @if ($latest->date)
                                            <span class="badge badge-secondary ml-1">
                                                {{ $latest->date->format('Y-m-d') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- توزيع أنواع الوجبات -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">توزيع أنواع الوجبات</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <div class="row text-center">
                                <div class="col-6 mb-4">
                                    <div class="h5 mb-0 font-weight-bold text-primary">{{ $stats['breakfast'] }}</div>
                                    <span class="text-xs">وجبات فطور</span>
                                </div>
                                <div class="col-6 mb-4">
                                    <div class="h5 mb-0 font-weight-bold text-success">{{ $stats['lunch'] }}</div>
                                    <span class="text-xs">وجبات غداء</span>
                                </div>
                                <div class="col-6">
                                    <div class="h5 mb-0 font-weight-bold text-warning">{{ $stats['dinner'] }}</div>
                                    <span class="text-xs">وجبات عشاء</span>
                                </div>
                                <div class="col-6">
                                    <div class="h5 mb-0 font-weight-bold text-info">{{ $stats['snack'] }}</div>
                                    <span class="text-xs">وجبات خفيفة</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> فطور
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> غداء
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> عشاء
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> خفيفة
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نموذج الإضافة -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">إضافة باقة وجبات جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('meal-packages.store') }}" method="POST">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label for="meal_id">الوجبة</label>
                            <select class="form-control" id="meal_id" name="meal_id" required>
                                <option value="">اختر الوجبة</option>
                                @foreach ($meals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="package_id">الباقة</label>
                            <select class="form-control" id="package_id" name="package_id" required>
                                <option value="">اختر الباقة</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">نوع الوجبة</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">اختر النوع</option>
                                <option value="breakfast">فطور</option>
                                <option value="lunch">غداء</option>
                                <option value="dinner">عشاء</option>
                                <option value="snack">وجبة خفيفة</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">التاريخ (اختياري)</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- نموذج التعديل -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">تعديل باقة الوجبات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label for="edit_meal_id">الوجبة</label>
                            <select class="form-control" id="edit_meal_id" name="meal_id" required>
                                <option value="">اختر الوجبة</option>
                                @foreach ($meals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_package_id">الباقة</label>
                            <select class="form-control" id="edit_package_id" name="package_id" required>
                                <option value="">اختر الباقة</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_type">نوع الوجبة</label>
                            <select class="form-control" id="edit_type" name="type" required>
                                <option value="">اختر النوع</option>
                                <option value="breakfast">فطور</option>
                                <option value="lunch">غداء</option>
                                <option value="dinner">عشاء</option>
                                <option value="snack">وجبة خفيفة</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_date">التاريخ (اختياري)</label>
                            <input type="date" class="form-control" id="edit_date" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .badge {
            font-size: 0.8em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .chart-pie {
            position: relative;
            height: 15rem;
            width: 100%;
        }

        @media (min-width: 768px) {
            .chart-pie {
                height: 20rem;
            }
        }

        .table {
            direction: rtl;
        }

        .text-right {
            text-align: right !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // معالجة عرض بيانات التعديل في المودال
        $('#editModal').on('show.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var mealId = button.data('meal-id');
            var packageId = button.data('package-id');
            var type = button.data('type');
            var date = button.data('date');

            var modal = $(this);
            modal.find('#edit_meal_id').val(mealId);
            modal.find('#edit_package_id').val(packageId);
            modal.find('#edit_type').val(type);
            modal.find('#edit_date').val(date);
            modal.find('#editForm').attr('action', '/meal-packages/' + id);
        });
    </script>
@endsection
