@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- إحصائيات الباقات -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">إجمالي الباقات</h6>
                                        <h3 class="mb-0">{{ $statistics['total_packages'] }}</h3>
                                    </div>
                                    <i class="fas fa-boxes fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">باقات نشطة</h6>
                                        <h3 class="mb-0">{{ $statistics['active_packages'] }}</h3>
                                    </div>
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">باقات غير نشطة</h6>
                                        <h3 class="mb-0">{{ $statistics['inactive_packages'] }}</h3>
                                    </div>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">إدارة الباقات</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPackageModal">
                            <i class="fas fa-plus"></i> إضافة باقة
                        </button>
                    </div>

                    <div class="card-body">
                        @include('components.alerts')

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>الاسم</th>
                                        <th>الفئة</th>
                                        <th>عدد الأيام</th>
                                        <th>عدد الوجبات</th>
                                        <th>السعر</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>
                                                @if ($package->image)
                                                    <img src="{{ asset('storage/' . $package->image) }}"
                                                        alt="{{ $package->name }}" width="50" height="50"
                                                        class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">لا يوجد صورة</span>
                                                @endif
                                            </td>
                                            <td>{{ $package->name }}</td>
                                            <td>{{ $package->category->name }}</td>
                                            <td>{{ $package->days_count }}</td>
                                            <td>{{ $package->max_meals }}</td>
                                            <td>{{ number_format($package->price, 2) }} ر.ق</td>
                                            <td>
                                                @if ($package->is_active)
                                                    <span class="badge badge-success">نشط</span>
                                                @else
                                                    <span class="badge badge-danger">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editPackageModal{{ $package->id }}">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deletePackageModal{{ $package->id }}">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                                <a href="{{ route('meal-packages.show', $package->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-list"></i> الوجبات
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal for each package -->
                                        <div class="modal fade" id="editPackageModal{{ $package->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editPackageModalLabel{{ $package->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editPackageModalLabel{{ $package->id }}">تعديل الباقة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @include('admin.packages.edit')
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal for each package -->
                                        <div class="modal fade" id="deletePackageModal{{ $package->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deletePackageModalLabel{{ $package->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deletePackageModalLabel{{ $package->id }}">حذف الباقة
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('packages.destroy', $package->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>هل أنت متأكد من رغبتك في حذف هذه الباقة؟</p>
                                                            <p><strong>{{ $package->name }}</strong></p>
                                                            @if ($package->image)
                                                                <p class="text-danger">سيتم حذف الصورة المرفقة أيضاً!</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف
                                                                الباقة</button>
                                                        </div>
                                                    </form>
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

    <!-- Add Package Modal -->
    <div class="modal fade" id="addPackageModal" tabindex="-1" role="dialog" aria-labelledby="addPackageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPackageModalLabel">إضافة باقة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('admin.packages.create')
            </div>
        </div>
    </div>
@endsection
