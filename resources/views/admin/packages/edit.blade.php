<form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="name">اسم الباقة *</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $package->name }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">الفئة *</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $package->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="days_count">عدد الأيام *</label>
            <input type="number" class="form-control" id="days_count" name="days_count"
                value="{{ $package->days_count }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="price">السعر (ر.ق) *</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price"
                value="{{ $package->price }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="special_conditions">شروط خاصة</label>
            <textarea class="form-control" id="special_conditions" name="special_conditions" rows="3">{{ $package->special_conditions }}</textarea>
        </div>

        <div class="form-group">
            <label for="max_meals">عدد الوجبات المسموح بها</label>
            <input type="number" class="form-control" id="max_meals" name="max_meals"
                value="{{ $package->max_meals }}" min="0">
        </div>

        <div class="form-group">
            <label for="image">صورة الباقة</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if ($package->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" width="100"
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
                    {{ $package->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">باقة
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
