<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">الاسم *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $user->email }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">الهاتف *</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}"
                        required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">كلمة المرور (اتركها فارغة
                        للحفاظ على الحالية)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">الجنس</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="">اختر الجنس</option>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>
                            ذكر</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>
                            أنثى</option>
                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>
                            آخر</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birth_date">تاريخ الميلاد</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ $user->birth_date }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="height">الطول (سم)</label>
                    <input type="number" step="0.01" class="form-control" id="height" name="height"
                        value="{{ $user->height }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="weight">الوزن (كجم)</label>
                    <input type="number" step="0.01" class="form-control" id="weight" name="weight"
                        value="{{ $user->weight }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">العنوان</label>
            <textarea class="form-control" id="address" name="address" rows="2">{{ $user->address }}</textarea>
        </div>

        <div class="form-group">
            <label for="health_notes">ملاحظات صحية</label>
            <textarea class="form-control" id="health_notes" name="health_notes" rows="3">{{ $user->health_notes }}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
        <button type="submit" class="btn btn-primary">حفظ
            التعديلات</button>
    </div>
</form>
