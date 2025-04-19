@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- بطاقات الإحصائيات -->
                <div class="row mb-4">
                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            إجمالي الفئات</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            فئات نشطة</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            فئات غير نشطة</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['inactive'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ban fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            تحتوي على صور</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['with_images'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-image fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                            جديدة هذا الأسبوع</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['new_this_week'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-star fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 mb-4">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            بدون صور</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $stats['total'] - $stats['with_images'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">إدارة الفئات</h6>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="fas fa-plus"></i> إضافة فئة جديدة
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
                                        <th width="5%">#</th>
                                        <th width="15%">الصورة</th>
                                        <th>الاسم</th>
                                        <th>الوصف</th>
                                        <th width="10%">الحالة</th>
                                        <th width="15%">تاريخ الإنشاء</th>
                                        <th width="12%">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td class="text-center">
                                                @if ($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}"
                                                        alt="{{ $category->name }}" class="img-thumbnail"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">بدون صورة</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description ? Str::limit($category->description, 50) : '---' }}
                                            </td>
                                            <td class="text-center">
                                                @if ($category->is_active)
                                                    <span class="badge badge-success p-2">نشط</span>
                                                @else
                                                    <span class="badge badge-danger p-2">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editCategoryModalLabel{{ $category->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="editCategoryModalLabel{{ $category->id }}">
                                                            تعديل الفئة: {{ $category->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-white">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('categories.update', $category->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="name">اسم الفئة *</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ $category->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="image">صورة الفئة</label>
                                                                        <input type="file" class="form-control-file"
                                                                            id="image" name="image">
                                                                        @if ($category->image)
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                                                    alt="{{ $category->name }}"
                                                                                    width="100" class="img-thumbnail">
                                                                                <div class="form-check mt-2">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id="remove_image"
                                                                                        name="remove_image">
                                                                                    <label class="form-check-label"
                                                                                        for="remove_image">حذف الصورة
                                                                                        الحالية</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">الوصف</label>
                                                                <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="is_active" name="is_active" value="1"
                                                                        {{ $category->is_active ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="is_active">فئة
                                                                        نشطة</label>
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
                                        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deleteCategoryModalLabel{{ $category->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title"
                                                            id="deleteCategoryModalLabel{{ $category->id }}">
                                                            تأكيد حذف الفئة
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-white">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من رغبتك في حذف الفئة التالية؟</p>
                                                        <div class="alert alert-warning">
                                                            <strong>الاسم:</strong> {{ $category->name }}<br>
                                                            <strong>الحالة:</strong>
                                                            {{ $category->is_active ? 'نشط' : 'غير نشط' }}<br>
                                                            @if ($category->image)
                                                                <strong>الصورة:</strong> موجودة<br>
                                                            @endif
                                                        </div>
                                                        <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <form action="{{ route('categories.destroy', $category->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">حذف
                                                                الفئة</button>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addCategoryModalLabel">إضافة فئة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">اسم الفئة *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">صورة الفئة</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="is_active">فئة نشطة</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ الفئة</button>
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-radius: 0;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
            border-radius: 10px;
        }

        .img-thumbnail {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        .table th {
            border-top: none;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
@endsection
