<form action="{{ route('meals.update', $meal->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">اسم الوجبة *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $meal->name }}"
                        required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">الفئة *</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                {{ $meal->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="option_id">خيارات
                        الوجبة</label>
                    <select class="form-control" id="option_id" name="option_id">
                        <option value="">بدون خيارات
                        </option>
                        @foreach (App\Models\MealOption::all() as $option)
                            <option value="{{ $option->id }}" {{ $meal->option_id == $option->id ? 'selected' : '' }}>
                                {{ $option->option_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">السعر (ر.ق) *</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="{{ $meal->price }}" min="0" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">الوصف</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $meal->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="calories">السعرات</label>
            <input type="number" class="form-control" id="calories" name="calories" value="{{ $meal->calories }}" min="0">
        </div>

        <div class="form-group">
            <label for="fat">الدهون</label>
            <input type="number" class="form-control" id="fat" name="fat" value="{{ $meal->fat }}" min="0">
        </div>

        <div class="form-group">
            <label for="carbohydrates">الكاربوهيدرات</label>
            <input type="number" class="form-control" id="carbohydrates" name="carbohydrates" value="{{ $meal->carbohydrates }}" min="0">
        </div>

        <div class="form-group">
            <label for="proteins">البروتينات</label>
            <input type="number" class="form-control" id="proteins" name="proteins" value="{{ $meal->proteins }}" min="0">
        </div>

        <div class="form-group">
            <label for="image">صورة الوجبة</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if ($meal->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" width="100"
                        class="img-thumbnail">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image">
                        <label class="form-check-label" for="remove_image">حذف الصورة
                            الحالية</label>
                    </div>
                </div>
            @endif
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                    {{ $meal->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">وجبة
                    نشطة</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
        <button type="submit" class="btn btn-primary">حفظ
            التغييرات</button>
    </div>
</form>
