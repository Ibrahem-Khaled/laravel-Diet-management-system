<div class="modal fade" id="addMealModal" tabindex="-1" role="dialog" aria-labelledby="addMealModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addMealModalLabel">إضافة وجبة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">اسم الوجبة *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">الفئة *</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">اختر الفئة</option>
                                    @foreach (App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="options">خيارات الوجبة (يمكن اختيار أكثر من خيار)</label>
                                <select class="form-control" id="options" name="options[]" multiple>
                                    @foreach (App\Models\Option::all() as $option)
                                        <option value="{{ $option->id }}">{{ $option->option_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">السعر (ر.ق) *</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    min="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="calories">السعرات</label>
                        <input type="number" class="form-control" id="calories" name="calories" min="0">
                    </div>
                    <div class="form-group">
                        <label for="fat">الدهون</label>
                        <input type="number" class="form-control" id="fat" name="fat" min="0">
                    </div>
                    <div class="form-group">
                        <label for="carbohydrates">الكاربوهيدرات</label>
                        <input type="number" class="form-control" id="carbohydrates" name="carbohydrates" min="0">
                    </div>
                    <div class="form-group">
                        <label for="proteins">البروتينات</label>
                        <input type="number" class="form-control" id="proteins" name="proteins" min="0">
                    </div>

                    <div class="form-group">
                        <label for="image">صورة الوجبة</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                value="1" checked>
                            <label class="form-check-label" for="is_active">وجبة نشطة</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ الوجبة</button>
                </div>
            </form>
        </div>
    </div>
</div>
