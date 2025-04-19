<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-brand-dark">
            <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Adaite Logo" class="h-8">
        </a>

        <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
            <a href="#home"
                class="text-gray-600 hover:text-brand nav-link-active px-3 py-2 rounded-md text-sm font-medium">الرئيسية</a>
            <a href="{{ route('packages') }}" class="text-gray-600 hover:text-brand px-3 py-2 rounded-md text-sm font-medium">خطط
                الحمية</a> <a href="#contact"
                class="text-gray-600 hover:text-brand px-3 py-2 rounded-md text-sm font-medium">اتصل بنا</a>
            <a href="#download" class="text-gray-600 hover:text-brand px-3 py-2 rounded-md text-sm font-medium">تحميل
                التطبيق</a>
        </div>

        <div class="hidden md:flex items-center space-x-3">
            <a href="{{ route('user.login') }}"
                class="font-medium py-2 px-5 rounded-lg transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                تسجيل الدخول
            </a>
        </div>

        <div class="md:hidden flex items-center">
            <button id="mobile-menu-button"
                class="outline-none mobile-menu-button p-2 rounded-md text-gray-500 hover:text-brand hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand">
                <span class="sr-only">Open main menu</span>
                <svg class=" h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    <div class="hidden mobile-menu md:hidden" id="mobile-menu">
        <ul class="pt-2 pb-3 space-y-1 px-2">
            <li><a href="#home"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand hover:bg-gray-50 nav-link-active">الرئيسية</a>
            </li>
            <li><a href="{{ route('packages') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand hover:bg-gray-50">خطط
                    الحمية</a></li>
            <li><a href="#contact"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand hover:bg-gray-50">اتصل
                    بنا</a></li>
            <li><a href="#download"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand hover:bg-gray-50">تحميل
                    التطبيق</a></li>
        </ul>
        <div class="pt-4 pb-3 border-t border-gray-200 px-5">
            <a href="{{ route('user.login') }}"
                class="block w-full text-center bg-brand hover:bg-brand-dark font-medium py-2 px-5 rounded-lg transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                تسجيل الدخول
            </a>
        </div>
    </div>
</header>
