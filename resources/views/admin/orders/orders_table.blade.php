<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th width="50px">#</th>
                <th>الوجبة</th>
                <th>العميل</th>
                <th>التاريخ</th>
                <th>الحالة</th>
                <th>المبلغ</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="order-card {{ $order->status }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ $order->meal_image ? asset('storage/' . $order->meal_image) : asset('images/default-meal.jpg') }}"
                                class="meal-image me-3" alt="صورة الوجبة">
                            <div>
                                <h6 class="mb-0">{{ $order->meal_name }}</h6>
                                <small class="text-muted">{{ $order->meal_category }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/avatars/' . (($order->user_id % 5) + 1) . '.jpg') }}"
                                class="rounded-circle me-2" width="30" height="30" alt="صورة العميل">
                            <span>{{ $order->user_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                        <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                    </td>
                    <td>
                        @if ($order->status == 'pending')
                            <span class="badge bg-info status-badge">
                                <i class="fas fa-clock me-1"></i> قيد الانتظار
                            </span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-warning status-badge">
                                <i class="fas fa-spinner me-1"></i> قيد التجهيز
                            </span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success status-badge">
                                <i class="fas fa-check-circle me-1"></i> مكتملة
                            </span>
                        @else
                            <span class="badge bg-danger status-badge">
                                <i class="fas fa-times-circle me-1"></i> مرفوضة
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="fw-bold">{{ number_format($order->total_price, 2) }} ر.ق</span>
                    </td>
                    <td>
                        <div class="d-flex order-actions">
                            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                data-bs-target="#editOrderModal{{ $order->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal"
                                data-bs-target="#statusOrderModal{{ $order->id }}">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                            {{-- <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <img src="{{ asset('images/empty-orders.svg') }}" alt="لا توجد طلبات" width="200"
                            class="mb-3">
                        <h5 class="text-muted">لا توجد طلبات متاحة</h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- @if ($orders->hasPages())
        <div class="card-footer bg-white border-top-0">
            {{ $orders->links() }}
        </div>
    @endif --}}
</div>
