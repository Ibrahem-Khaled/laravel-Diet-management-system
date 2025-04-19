<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoBalence - تسجيل الدخول</title>
    <link rel="icon" href="{{ asset('assets/img/logo2.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            DEFAULT: '#10B981',
                            light: '#A7F3D0',
                            dark: '#047857',
                        },
                        secondary: {
                            DEFAULT: '#F59E0B',
                            light: '#FCD34D',
                            dark: '#B45309'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .auth-container {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .step-indicator {
            width: 35px;
            height: 35px;
        }

        .step-divider {
            height: 2px;
            width: 50px;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-16 w-auto" src="{{ asset('assets/img/logo2.jpeg') }}" alt="GoBalence Logo">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                مرحباً بك في GoBalence
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-2xl">
            <div class="bg-white py-8 px-4 auth-container rounded-lg sm:px-10">
                <!-- Step Indicator -->
                <div class="flex items-center justify-center mb-10">
                    <div class="flex items-center">
                        <div id="step1"
                            class="step-indicator rounded-full bg-brand text-white flex items-center justify-center font-bold">
                            1
                        </div>
                        <div id="divider1" class="step-divider bg-gray-300 mx-2"></div>
                        <div id="step2"
                            class="step-indicator rounded-full border-2 border-gray-300 text-gray-400 flex items-center justify-center font-bold">
                            2
                        </div>
                    </div>
                </div>

                <!-- Phone Login Form -->
                <div id="phoneForm" class="space-y-6">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">
                            رقم الهاتف
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select id="countryCode"
                                    class="focus:ring-brand focus:border-brand h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                    <option>+966</option>
                                    <option>+20</option>
                                    <option>+971</option>
                                    <option>+965</option>
                                    <option>+962</option>
                                </select>
                            </div>
                            <input id="phone" name="phone" type="tel" autocomplete="tel" required
                                class="input-field block w-full pr-24 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand focus:border-brand sm:text-sm"
                                placeholder="5XXXXXXXX">
                        </div>
                    </div>

                    <div>
                        <button type="button" onclick="verifyPhone()"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand">
                            تأكيد رقم الهاتف
                        </button>
                    </div>
                </div>

                <!-- User Details Form (Hidden Initially) -->
                <div id="userDetailsForm" class="hidden space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            الاسم
                        </label>
                        <input id="name" name="name" type="text"
                            class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                العنوان
                            </label>
                            <input id="address" name="address" type="text"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm">
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">
                                الجنس
                            </label>
                            <select id="gender" name="gender"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm">
                                <option value="" selected disabled>اختر الجنس</option>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                                <option value="other">أخرى</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">
                                تاريخ الميلاد
                            </label>
                            <input id="birth_date" name="birth_date" type="date"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm">
                        </div>

                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700">
                                الطول (سم)
                            </label>
                            <input id="height" name="height" type="number" step="0.1"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm"
                                placeholder="مثال: 170">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">
                                الوزن (كجم)
                            </label>
                            <input id="weight" name="weight" type="number" step="0.1"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm"
                                placeholder="مثال: 75.5">
                        </div>

                        <div>
                            <label for="health_notes" class="block text-sm font-medium text-gray-700">
                                ملاحظات صحية (اختياري)
                            </label>
                            <textarea id="health_notes" name="health_notes" rows="1"
                                class="input-field mt-1 block w-full py-3 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-brand focus:border-brand sm:text-sm"
                                placeholder="أي حساسية أو أمراض مزمنة"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" onclick="backToPhone()"
                            class="text-sm text-brand hover:text-brand-dark font-medium">
                            <i class="fas fa-arrow-right ml-1"></i> العودة
                        </button>

                        <button type="button" onclick="submitDetails()"
                            class="py-3 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand">
                            حفظ البيانات والمتابعة
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    عند المتابعة، أنت توافق على
                    <a href="#" class="font-medium text-brand hover:text-brand-dark">شروط الاستخدام</a>
                    و
                    <a href="#" class="font-medium text-brand hover:text-brand-dark">سياسة الخصوصية</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function verifyPhone() {
            const phone = document.getElementById('phone').value;
            const countryCode = document.getElementById('countryCode').value;

            if (!phone) {
                alert('الرجاء إدخال رقم الهاتف');
                return;
            }

            // Here you would normally send the phone number to your backend
            // For demo purposes, we'll just show the next form
            document.getElementById('phoneForm').classList.add('hidden');
            document.getElementById('userDetailsForm').classList.remove('hidden');

            // Update step indicator
            document.getElementById('step1').classList.remove('bg-brand');
            document.getElementById('step1').classList.add('bg-green-100', 'text-brand');
            document.getElementById('divider1').classList.remove('bg-gray-300');
            document.getElementById('divider1').classList.add('bg-brand');
            document.getElementById('step2').classList.remove('border-gray-300', 'text-gray-400');
            document.getElementById('step2').classList.add('bg-brand', 'text-white');
        }

        function backToPhone() {
            document.getElementById('phoneForm').classList.remove('hidden');
            document.getElementById('userDetailsForm').classList.add('hidden');

            // Revert step indicator
            document.getElementById('step1').classList.add('bg-brand', 'text-white');
            document.getElementById('step1').classList.remove('bg-green-100', 'text-brand');
            document.getElementById('divider1').classList.add('bg-gray-300');
            document.getElementById('divider1').classList.remove('bg-brand');
            document.getElementById('step2').classList.add('border-gray-300', 'text-gray-400');
            document.getElementById('step2').classList.remove('bg-brand', 'text-white');
        }

        function submitDetails() {
            // Here you would collect all form data and send to your backend
            const formData = {
                phone: document.getElementById('countryCode').value + document.getElementById('phone').value,
                address: document.getElementById('address').value,
                gender: document.getElementById('gender').value,
                birth_date: document.getElementById('birth_date').value,
                height: document.getElementById('height').value,
                weight: document.getElementById('weight').value,
                health_notes: document.getElementById('health_notes').value
            };

            // Validate required fields
            if (!formData.gender || !formData.birth_date || !formData.height || !formData.weight) {
                alert('الرجاء إدخال جميع الحقول المطلوبة');
                return;
            }

            // For demo purposes, just log the data
            console.log('Form data to be submitted:', formData);
            alert('تم حفظ البيانات بنجاح! (هذه مجرد تجربة)');

            // In a real app, you would redirect to dashboard or next page
            // window.location.href = '/dashboard';
        }
    </script>
</body>

</html>
