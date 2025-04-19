@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- إحصائيات الفئات -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">إجمالي الفئات</h6>
                                        <h3 class="mb-0">{{ $statistics['total_categories'] }}</h3>
                                    </div>
                                    <i class="fas fa-list-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">فئات نشطة</h6>
                                        <h3 class="mb-0">{{ $statistics['active_categories'] }}</h3>
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
                                        <h6 class="card-title">فئات غير نشطة</h6>
                                        <h3 class="mb-0">{{ $statistics['inactive_categories'] }}</h3>
                                    </div>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">إدارة فئات الباقات</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="fas fa-plus"></i> إضافة فئة
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
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                @if ($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}"
                                                        alt="{{ $category->name }}" width="50" height="50"
                                                        class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">لا يوجد صورة</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description ? Str::limit($category->description, 50) : 'لا يوجد وصف' }}
                                            </td>
                                            <td>
                                                @if ($category->is_active)
                                                    <span class="badge badge-success">نشط</span>
                                                @else
                                                    <span class="badge badge-danger">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal for each category -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editCategoryModalLabel{{ $category->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editCategoryModalLabel{{ $category->id }}">تعديل الفئة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('package-categories.update', $category->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="name">اسم الفئة *</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $category->name }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="description">الوصف</label>
                                                                <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="image">صورة الفئة</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="image" name="image">
                                                                @if ($category->image)
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset('storage/' . $category->image) }}"
                                                                            alt="{{ $category->name }}" width="100"
                                                                            class="img-thumbnail">
                                                                        <div class="form-check mt-2">
                                                                            <input type="checkbox" class="form-check-input"
                                                                                id="remove_image" name="remove_image">
                                                                            <label class="form-check-label"
                                                                                for="remove_image">حذف الصورة
                                                                                الحالية</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
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

                                        <!-- Delete Modal for each category -->
                                        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deleteCategoryModalLabel{{ $category->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteCategoryModalLabel{{ $category->id }}">حذف الفئة
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('package-categories.destroy', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>هل أنت متأكد من رغبتك في حذف هذه الفئة؟</p>
                                                            <p><strong>{{ $category->name }}</strong></p>
                                                            @if ($category->image)
                                                                <p class="text-danger">سيتم حذف الصورة المرفقة أيضاً!</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف
                                                                الفئة</button>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">إضافة فئة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('package-categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">اسم الفئة *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">صورة الفئة</label>
                            <input type="file" class="form-control-file" id="image" name="image">
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
