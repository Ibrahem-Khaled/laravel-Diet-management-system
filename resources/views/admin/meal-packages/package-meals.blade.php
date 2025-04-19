@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- بطاقات الإحصائيات -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body text-right">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-utensils fa-2x text-gray-300"></i>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    إجمالي الوجبات</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $packageStats['total_meals'] }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $packageStats['breakfast'] }}</div>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">وجبات الغداء</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $packageStats['lunch'] }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $packageStats['dinner'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">وجبات باقة: {{ $package->name }}</h6>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMealModal">
                    <i class="fas fa-plus"></i> إضافة وجبة
                </button>
                <a href="{{ route('meal-packages.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> رجوع
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>الوجبة</th>
                                <th>النوع</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($package->meals as $meal)
                                <tr>
                                    <td>{{ $meal->name }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $meal->pivot->type == 'breakfast' ? 'primary' : ($meal->pivot->type == 'lunch' ? 'success' : ($meal->pivot->type == 'dinner' ? 'warning' : 'info')) }}">
                                            @if ($meal->pivot->type == 'breakfast')
                                                فطور
                                            @elseif($meal->pivot->type == 'lunch')
                                                غداء
                                            @elseif($meal->pivot->type == 'dinner')
                                                عشاء
                                            @else
                                                وجبة خفيفة
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $meal->pivot->date ? $meal->pivot->date->format('Y-m-d') : 'غير محدد' }}</td>
                                    <td>
                                        <form action="{{ route('meal-packages.remove-meal', $package->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="meal_id" value="{{ $meal->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('هل أنت متأكد من حذف هذه الوجبة من الباقة؟')">
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

    <!-- Modal إضافة وجبة جديدة -->
    <div class="modal fade" id="addMealModal" tabindex="-1" role="dialog" aria-labelledby="addMealModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMealModalLabel">إضافة وجبة جديدة للباقة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('meal-packages.add-meal', $package->id) }}" method="POST">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label for="add_meal_id">الوجبة</label>
                            <select class="form-control" id="add_meal_id" name="meal_id" required>
                                <option value="">اختر الوجبة</option>
                                @foreach ($allMeals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_type">نوع الوجبة</label>
                            <select class="form-control" id="add_type" name="type" required>
                                <option value="">اختر النوع</option>
                                <option value="breakfast">فطور</option>
                                <option value="lunch">غداء</option>
                                <option value="dinner">عشاء</option>
                                <option value="snack">وجبة خفيفة</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_date">التاريخ (اختياري)</label>
                            <input type="date" class="form-control" id="add_date" name="date">
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
@endsection
