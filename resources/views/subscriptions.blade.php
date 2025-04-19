<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoBalence - خطط الاشتراك</title>
    <link rel="icon" href="{{ asset('assets/img/logo2.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                        premium: {
                            DEFAULT: '#F59E0B',
                            light: '#FCD34D',
                            dark: '#B45309'
                        }
                    },
                    boxShadow: {
                        '3d': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.04)',
                        'glow': '0 0 15px rgba(16, 185, 129, 0.3)'
                    }
                }
            }
        }
    </script>
    <style>
        .pricing-card {
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
        }

        .premium-card {
            position: relative;
            overflow: hidden;
        }

        .premium-card::before {
            content: "الأكثر مبيعاً";
            position: absolute;
            top: 20px;
            left: -35px;
            width: 150px;
            padding: 2px 0;
            background-color: #F59E0B;
            color: white;
            text-align: center;
            transform: rotate(-45deg);
            font-size: 12px;
            font-weight: bold;
        }

        .feature-list li {
            position: relative;
            padding-right: 25px;
            margin-bottom: 10px;
        }

        .feature-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 0;
            color: #10B981;
        }

        .premium-feature::before {
            color: #F59E0B;
        }

        .toggle-checkbox:checked {
            right: 0;
            background-color: #10B981;
        }

        .toggle-checkbox:checked+.toggle-label {
            background-color: #A7F3D0;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Header -->
    @include('components.web.nav')

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-white to-gray-50 py-16 md:py-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">خطط الاشتراك التي تناسب <span
                    class="text-brand">أهدافك</span></h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                اختر الخطة التي تتناسب مع احتياجاتك الصحية واستفد من برامج التغذية المخصصة لدينا
            </p>

            <!-- Toggle Switch -->
            <div class="flex items-center justify-center mb-12">
                <span class="mr-3 text-gray-600 font-medium">الدفع الشهري</span>
                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                    <input type="checkbox" name="toggle" id="toggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                    <label for="toggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span class="text-gray-600 font-medium">الدفع السنوي <span class="text-brand">(وفر 20%)</span></span>
            </div>
        </div>
    </section>

    <!-- Pricing Plans -->
    <section id="pricing" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Basic Plan -->
                <div class="pricing-card bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">الخطة الأساسية</h3>
                        <p class="text-gray-600">مناسبة للمبتدئين</p>
                    </div>
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800">99 <span class="text-xl">ر.ق</span></span>
                        <span class="text-gray-500 block">/ شهرياً</span>
                    </div>
                    <ul class="feature-list mb-8">
                        <li>خطة غذائية أساسية</li>
                        <li>متابعة أسبوعية</li>
                        <li>10 وصفات صحية</li>
                        <li>تطبيق الهاتف</li>
                        <li class="text-gray-400 line-through">استشارة أخصائي</li>
                        <li class="text-gray-400 line-through">خطط تمارين</li>
                    </ul>
                    <button
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-200">
                        ابدأ الآن
                    </button>
                </div>

                <!-- Premium Plan (Featured) -->
                <div
                    class="pricing-card premium-card bg-white border-2 border-premium-light rounded-xl p-6 shadow-lg hover:shadow-glow transform hover:scale-105">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">الخطة المميزة</h3>
                        <p class="text-premium-dark font-medium">الأفضل للأهداف الصحية</p>
                    </div>
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800">199 <span class="text-xl">ر.ق</span></span>
                        <span class="text-gray-500 block">/ شهرياً</span>
                    </div>
                    <ul class="feature-list mb-8">
                        <li class="premium-feature">خطة غذائية مخصصة</li>
                        <li class="premium-feature">متابعة يومية</li>
                        <li class="premium-feature">وصفات غير محدودة</li>
                        <li class="premium-feature">تطبيق الهاتف</li>
                        <li class="premium-feature">استشارة أخصائي</li>
                        <li class="premium-feature">خطط تمارين شخصية</li>
                    </ul>
                    <button
                        class="w-full bg-premium hover:bg-premium-dark text-white font-medium py-3 px-4 rounded-lg transition duration-200 shadow-md">
                        الاختيار المفضل
                    </button>
                </div>

                <!-- Family Plan -->
                <div class="pricing-card bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">خطة العائلة</h3>
                        <p class="text-gray-600">لصحة جميع أفراد العائلة</p>
                    </div>
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800">349 <span class="text-xl">ر.ق</span></span>
                        <span class="text-gray-500 block">/ شهرياً</span>
                    </div>
                    <ul class="feature-list mb-8">
                        <li>خطط غذائية لـ 4 أفراد</li>
                        <li>متابعة أسبوعية</li>
                        <li>50 وصفة صحية</li>
                        <li>تطبيق الهاتف</li>
                        <li>استشارة أخصائي</li>
                        <li class="text-gray-400 line-through">خطط تمارين</li>
                    </ul>
                    <button
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-200">
                        ابدأ الآن
                    </button>
                </div>
            </div>

            <!-- Custom Plan -->
            <div class="max-w-2xl mx-auto mt-16 bg-brand-light rounded-xl p-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">هل تحتاج إلى خطة مخصصة؟</h3>
                <p class="text-gray-700 mb-6">يمكننا تصميم خطة تناسب احتياجاتك الخاصة وأهدافك الصحية الفريدة</p>
                <button
                    class="bg-white hover:bg-gray-100 text-brand font-medium py-3 px-8 rounded-lg border border-brand transition duration-200 shadow-sm">
                    تحدث مع أخصائي التغذية
                </button>
            </div>
        </div>
    </section>

    <!-- Features Comparison -->
    <section id="features" class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">مقارنة المميزات</h2>

            <div class="overflow-x-auto">
                <table class="w-full max-w-4xl mx-auto bg-white rounded-lg overflow-hidden shadow-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-4 px-6 text-right font-semibold text-gray-700">الميزة</th>
                            <th class="py-4 px-6 text-center font-semibold text-gray-700">الأساسية</th>
                            <th class="py-4 px-6 text-center font-semibold text-gray-700">المميزة</th>
                            <th class="py-4 px-6 text-center font-semibold text-gray-700">العائلة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-4 px-6 text-right font-medium text-gray-700">عدد الخطط الغذائية</td>
                            <td class="py-4 px-6 text-center">1</td>
                            <td class="py-4 px-6 text-center">1</td>
                            <td class="py-4 px-6 text-center">4</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="py-4 px-6 text-right font-medium text-gray-700">تعديلات الخطة</td>
                            <td class="py-4 px-6 text-center">شهرياً</td>
                            <td class="py-4 px-6 text-center">أسبوعياً</td>
                            <td class="py-4 px-6 text-center">شهرياً</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 text-right font-medium text-gray-700">استشارات أخصائي</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-premium-dark font-medium">4 شهرياً</td>
                            <td class="py-4 px-6 text-center">2 شهرياً</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="py-4 px-6 text-right font-medium text-gray-700">خطط التمارين</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-premium-dark font-medium"><i
                                    class="fas fa-check"></i></td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 text-right font-medium text-gray-700">المتابعة</td>
                            <td class="py-4 px-6 text-center">أسبوعية</td>
                            <td class="py-4 px-6 text-center text-premium-dark font-medium">يومية</td>
                            <td class="py-4 px-6 text-center">أسبوعية</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="py-4 px-6 text-right font-medium text-gray-700">الوصفات</td>
                            <td class="py-4 px-6 text-center">10 شهرياً</td>
                            <td class="py-4 px-6 text-center text-premium-dark font-medium">غير محدود</td>
                            <td class="py-4 px-6 text-center">50 شهرياً</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">آراء عملائنا</h2>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg"
                                alt="">
                        </div>
                        <div class="mr-3">
                            <h4 class="text-lg font-medium text-gray-800">سارة محمد</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "بفضل GoBalence تمكنت من فقدان 12 كجم في 3 أشهر بطريقة صحية. الخطط الغذائية لذيذة ومتنوعة!"
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/men/45.jpg"
                                alt="">
                        </div>
                        <div class="mr-3">
                            <h4 class="text-lg font-medium text-gray-800">أحمد خالد</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "الخطة المميزة تستحق كل ريال. الأخصائية كانت متابعة معي يومياً وساعدتني في بناء عادات غذائية
                        صحية."
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                                alt="">
                        </div>
                        <div class="mr-3">
                            <h4 class="text-lg font-medium text-gray-800">نورة عبدالله</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "اشتريت خطة العائلة وكل أفراد أسرتي سعداء بالوجبات الصحية واللذيذة. شكراً لفريق GoBalence!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">الأسئلة الشائعة</h2>

            <div class="space-y-4">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <button class="flex justify-between items-center w-full text-right" onclick="toggleFAQ(1)">
                        <h3 class="text-lg font-medium text-gray-800">كيف يتم إعداد الخطة الغذائية؟</h3>
                        <i class="fas fa-chevron-down text-brand transform transition-transform duration-200"
                            id="faqIcon1"></i>
                    </button>
                    <div class="mt-3 text-gray-600 hidden" id="faqContent1">
                        <p>نقوم بإعداد خطط غذائية مخصصة بناءً على معلوماتك الصحية وأهدافك وتفضيلاتك الغذائية. بعد
                            التسجيل، سنجري تقييماً شاملاً لاحتياجاتك ثم نرسل لك خطة متكاملة خلال 24-48 ساعة.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <button class="flex justify-between items-center w-full text-right" onclick="toggleFAQ(2)">
                        <h3 class="text-lg font-medium text-gray-800">هل يمكنني تعديل أو إلغاء اشتراكي؟</h3>
                        <i class="fas fa-chevron-down text-brand transform transition-transform duration-200"
                            id="faqIcon2"></i>
                    </button>
                    <div class="mt-3 text-gray-600 hidden" id="faqContent2">
                        <p>نعم، يمكنك تعديل أو إلغاء اشتراكك في أي وقت من خلال حسابك. الإلغاء قبل نهاية الفترة المدفوعة
                            يعني أن الخدمة ستستمر حتى نهاية تلك الفترة ولن يتم تجديد الاشتراك تلقائياً.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <button class="flex justify-between items-center w-full text-right" onclick="toggleFAQ(3)">
                        <h3 class="text-lg font-medium text-gray-800">ما هي طرق الدفع المتاحة؟</h3>
                        <i class="fas fa-chevron-down text-brand transform transition-transform duration-200"
                            id="faqIcon3"></i>
                    </button>
                    <div class="mt-3 text-gray-600 hidden" id="faqContent3">
                        <p>نحن نقبل الدفع عبر بطاقات الائتمان (Visa/Mastercard) ومدى وApple Pay وSTC Pay. جميع عمليات
                            الدفع تتم عبر بوابات دفع آمنة ومشفرة.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <button class="flex justify-between items-center w-full text-right" onclick="toggleFAQ(4)">
                        <h3 class="text-lg font-medium text-gray-800">هل هناك ضمان استرداد الأموال؟</h3>
                        <i class="fas fa-chevron-down text-brand transform transition-transform duration-200"
                            id="faqIcon4"></i>
                    </button>
                    <div class="mt-3 text-gray-600 hidden" id="faqContent4">
                        <p>نقدم ضمان استرداد الأموال خلال 14 يومًا من الاشتراك إذا لم تكن راضيًا عن الخدمة. فقط اتصل
                            بفريق الدعم وسنقوم بإجراء الاسترداد دون أي أسئلة.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-brand">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">جاهز لبدء رحلتك الصحية؟</h2>
            <p class="text-white text-lg mb-8 max-w-2xl mx-auto">انضم إلى آلاف الأشخاص الذين حققوا أهدافهم الصحية مع
                GoBalence</p>
            <a href="#pricing"
                class="inline-block bg-white hover:bg-gray-100 text-brand font-bold py-3 px-8 rounded-lg shadow-md transition duration-200">
                اختر خطتك الآن
            </a>
        </div>
    </section>

    <!-- Footer -->
    @include('components.web.footer')

    <script>
        // Toggle FAQ items
        function toggleFAQ(num) {
            const content = document.getElementById(`faqContent${num}`);
            const icon = document.getElementById(`faqIcon${num}`);

            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Toggle switch functionality
        const toggle = document.getElementById('toggle');
        const basicPrice = document.querySelectorAll('.pricing-card:nth-child(1) span:nth-child(1)');
        const premiumPrice = document.querySelectorAll('.pricing-card:nth-child(2) span:nth-child(1)');
        const familyPrice = document.querySelectorAll('.pricing-card:nth-child(3) span:nth-child(1)');

        toggle.addEventListener('change', function() {
            if (this.checked) {
                // Annual pricing (with 20% discount)
                basicPrice.forEach(el => el.textContent = '79');
                premiumPrice.forEach(el => el.textContent = '159');
                familyPrice.forEach(el => el.textContent = '279');
            } else {
                // Monthly pricing
                basicPrice.forEach(el => el.textContent = '99');
                premiumPrice.forEach(el => el.textContent = '199');
                familyPrice.forEach(el => el.textContent = '349');
            }
        });
    </script>
</body>

</html>
