@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- إضافة بطاقات الإحصائيات -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">إجمالي المستخدمين</h6>
                                        <h3 class="mb-0">{{ $statistics['total_users'] }}</h3>
                                    </div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">مستخدمين نشطين</h6>
                                        <h3 class="mb-0">{{ $statistics['active_users'] }}</h3>
                                    </div>
                                    <i class="fas fa-user-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">ذكور</h6>
                                        <h3 class="mb-0">{{ $statistics['male_users'] }}</h3>
                                    </div>
                                    <i class="fas fa-male fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">إناث</h6>
                                        <h3 class="mb-0">{{ $statistics['female_users'] }}</h3>
                                    </div>
                                    <i class="fas fa-female fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">إدارة المستخدمين</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                            <i class="fas fa-plus"></i> إضافة مستخدم
                        </button>
                    </div>

                    <div class="card-body">
                       @include('components.alerts')

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الهاتف</th>
                                        <th>الجنس</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email ?? 'غير محدد' }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->gender == 'male')
                                                    ذكر
                                                @elseif($user->gender == 'female')
                                                    أنثى
                                                @elseif($user->gender == 'other')
                                                    آخر
                                                @else
                                                    غير محدد
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->email_verified_at)
                                                    <span class="badge badge-success">نشط</span>
                                                @else
                                                    <span class="badge badge-warning">غير مفعل</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editUserModal{{ $user->id }}">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteUserModal{{ $user->id }}">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal for each user -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">
                                                            تعديل المستخدم</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @include('admin.users.edit', ['user' => $user])
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal for each user -->
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteUserModalLabel{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteUserModalLabel{{ $user->id }}">حذف المستخدم</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>هل أنت متأكد من رغبتك في حذف هذا المستخدم؟</p>
                                                            <p><strong>{{ $user->name }}</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف
                                                                المستخدم</button>
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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('admin.users.create')
            </div>
        </div>
    </div>
@endsection
