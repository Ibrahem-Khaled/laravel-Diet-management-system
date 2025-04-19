<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">قائمة الوجبات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addMealModal">
                    <i class="fas fa-plus"></i> إضافة وجبة جديدة
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">الصورة</th>
                                <th>الاسم</th>
                                <th>الفئة</th>
                                <th width="10%">السعر</th>
                                <th width="10%">الحالة</th>
                                <th width="15%">الخيارات</th>
                                <th width="12%">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $meal)
                                <tr>
                                    <td>{{ $meal->id }}</td>
                                    <td class="text-center">
                                        @if ($meal->image)
                                            <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}"
                                                class="img-thumbnail"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">بدون صورة</span>
                                        @endif
                                    </td>
                                    <td>{{ $meal->name }}</td>
                                    <td>{{ $meal->category->name }}</td>
                                    <td>{{ number_format($meal->price, 2) }} ر.ق</td>
                                    <td class="text-center">
                                        @if ($meal->is_active)
                                            <span class="badge badge-success p-2">نشط</span>
                                        @else
                                            <span class="badge badge-danger p-2">غير نشط</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($meal->options as $option)
                                            <span class="badge badge-info">{{ $option->option_name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#editMealModal{{ $meal->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteMealModal{{ $meal->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Meal Modal -->
                                <div class="modal fade" id="editMealModal{{ $meal->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editMealModalLabel{{ $meal->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editMealModalLabel{{ $meal->id }}">
                                                    تعديل وجبة: {{ $meal->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            @include('admin.meals.update')
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Meal Modal -->
                                <div class="modal fade" id="deleteMealModal{{ $meal->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteMealModalLabel{{ $meal->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteMealModalLabel{{ $meal->id }}">
                                                    تأكيد حذف الوجبة
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>هل أنت متأكد من رغبتك في حذف الوجبة التالية؟</p>
                                                <div class="alert alert-warning">
                                                    <strong>الاسم:</strong> {{ $meal->name }}<br>
                                                    <strong>الفئة:</strong> {{ $meal->category->name }}<br>
                                                    <strong>السعر:</strong>
                                                    {{ number_format($meal->price, 2) }} ر.ق
                                                </div>
                                                <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                <form action="{{ route('meals.destroy', $meal->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف
                                                        الوجبة</button>
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

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">خيارات الوجبات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addOptionModal">
                    <i class="fas fa-plus"></i> إضافة خيار
                </button>
            </div>
            <div class="card-body">
                @if (session('success-option'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success-option') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>الخيار</th>
                                <th>القيم</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\Option::all() as $option)
                                <tr>
                                    <td>{{ $option->option_name }}</td>
                                    <td>{{ $option->option_values ?: '---' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#editOptionModal{{ $option->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteOptionModal{{ $option->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Option Modal -->
                                <div class="modal fade" id="editOptionModal{{ $option->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editOptionModalLabel{{ $option->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editOptionModalLabel{{ $option->id }}">
                                                    تعديل خيار: {{ $option->option_name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('meal-options.update', $option->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="option_name">اسم الخيار *</label>
                                                        <input type="text" class="form-control" id="option_name"
                                                            name="option_name" value="{{ $option->option_name }}"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option_values">قيم الخيار (افصلها
                                                            بفواصل)</label>
                                                        <textarea class="form-control" id="option_values" name="option_values" rows="3">{{ $option->option_values }}</textarea>
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

                                <!-- Delete Option Modal -->
                                <div class="modal fade" id="deleteOptionModal{{ $option->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteOptionModalLabel{{ $option->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title"
                                                    id="deleteOptionModalLabel{{ $option->id }}">
                                                    تأكيد حذف الخيار
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>هل أنت متأكد من رغبتك في حذف الخيار التالي؟</p>
                                                <div class="alert alert-warning">
                                                    <strong>الاسم:</strong> {{ $option->option_name }}<br>
                                                    <strong>القيم:</strong>
                                                    {{ $option->option_values ?: 'لا يوجد' }}
                                                </div>
                                                <p class="text-danger">سيتم إزالة هذا الخيار من جميع
                                                    الوجبات المرتبطة به!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                <form action="{{ route('meal-options.destroy', $option->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف
                                                        الخيار</button>
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
