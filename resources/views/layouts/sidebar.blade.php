<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">لوحة التحكم</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>لوحة التحكم</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        الادارات
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>المستخدمين</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('package-categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>انواع الباقات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('packages.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>الباقات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('subscriptions.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>الاشتراكات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>فئات الوجبات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('meals.index') }}">
            <i class="fas fa-fw fa-cheese"></i>
            <span>الوجبات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('meal-packages.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>باقات الوجبات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="fas fa-fw fa-bars"></i>
            <span>الطلبات</span></a>
    </li>
   
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
