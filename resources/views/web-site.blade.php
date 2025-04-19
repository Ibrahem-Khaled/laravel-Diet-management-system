<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoBalence - طريقك لصحة أفضل</title>
    <link rel="icon" href="{{ asset('assets/img/logo2.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: { // Green color palette for health/diet theme
                            DEFAULT: '#10B981', // Main Green (Emerald 500)
                            light: '#A7F3D0', // Light Green (Emerald 200)
                            dark: '#047857', // Dark Green (Emerald 700)
                        },
                        secondary: { // Optional complementary color
                            DEFAULT: '#F59E0B', // Amber 500 (Warm contrast)
                            light: '#FCD34D', // Amber 300
                            dark: '#B45309' // Amber 700
                        },
                        gray: {
                            ...tailwind.theme.colors.gray,
                            '850': '#18212f' // Dark gray for footer
                        }
                    }
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1f2937;
            /* Default text color */
        }

        .nav-link-active {
            color: #10B981;
            font-weight: 600;
        }

        .footer-link:hover {
            color: #10B981;
            text-decoration: underline;
        }

        /* Custom gradient for hero (optional) */
        .hero-gradient {
            background: linear-gradient(135deg, #ffffff 60%, #A7F3D0 100%);
        }

        /* Style for feature icons */
        .feature-icon {
            background-color: #A7F3D0;
            /* brand-light */
            color: #047857;
            /* brand-dark */
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.75rem;
            /* text-3xl */
        }
    </style>
</head>

<body class="antialiased">

    @include('components.web.nav')
    <main>
        <section id="home" class="hero-gradient">
            <div class="container mx-auto px-6 py-20 md:py-28 lg:py-36 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 lg:w-3/5 text-center md:text-right mb-12 md:mb-0 md:pr-10 lg:pr-16">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-850 mb-5 leading-tight">
                        ابدأ رحلتك نحو <span class="text-brand">صحة أفضل</span> اليوم!
                    </h1>
                    <p class="text-lg text-gray-700 mb-8">
                        احصل على خطط حمية مخصصة ووصفات صحية لذيذة ومتابعة مستمرة من خبراء التغذية لمساعدتك في تحقيق
                        أهدافك الصحية والوصول إلى وزنك المثالي.
                    </p>
                    <div
                        class="flex flex-col sm:flex-row justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-4 sm:space-x-reverse">
                        <a href="#packages"
                            class="bg-brand hover:bg-brand-dark text-brand font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out shadow-lg hover:shadow-xl text-lg w-full sm:w-auto">
                            اكتشف خططنا الغذائية
                        </a>
                        <a href="#features"
                            class="bg-white hover:bg-gray-100 text-brand border border-brand font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out text-lg w-full sm:w-auto">
                            تعرف على مميزاتنا
                        </a>
                    </div>
                </div>

                <div class="md:w-1/2 lg:w-2/5 mt-10 md:mt-0">
                    <img src="{{ asset('assets/img/hero-section-img.jpg') }}" alt="[صورة لطعام صحي ونمط حياة صحي]"
                        class="rounded-lg shadow-xl mx-auto w-full max-w-md md:max-w-full"
                        onerror="this.onerror=null; this.src='https://placehold.co/600x450/E2E8F0/4A5568?text=Image+Not+Found';">
                </div>
            </div>
        </section>

        <section id="features" class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-850 mb-4">لماذا تختار
                    <span class="text-brand font-bold">نحن</span>
                </h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">نحن نقدم لك الأدوات والدعم الذي تحتاجه
                    لتحقيق أهدافك الصحية بطريقة مستدامة وممتعة.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <div class="p-6">
                        <div class="feature-icon"><i class="fas fa-clipboard-list"></i></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-850">خطط مخصصة</h3>
                        <p class="text-gray-600">خطط غذائية مصممة خصيصًا لتناسب احتياجاتك وأهدافك وأسلوب حياتك.</p>
                    </div>
                    <div class="p-6">
                        <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-850">وصفات صحية</h3>
                        <p class="text-gray-600">مكتبة واسعة من الوصفات اللذيذة والصحية سهلة التحضير.</p>
                    </div>
                    <div class="p-6">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-850">تتبع التقدم</h3>
                        <p class="text-gray-600">أدوات سهلة لمتابعة تقدمك وتحفيزك على الاستمرار.</p>
                    </div>
                    <div class="p-6">
                        <div class="feature-icon"><i class="fas fa-headset"></i></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-850">دعم الخبراء</h3>
                        <p class="text-gray-600">تواصل مباشر مع أخصائيي تغذية معتمدين للإجابة على استفساراتك.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="py-16 md:py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-850 mb-12">كيف يعمل؟</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-center">
                    <div class="text-center p-4">
                        <div class="text-5xl text-brand mb-4">1</div>
                        <h3 class="text-xl font-semibold mb-2">حدد أهدافك</h3>
                        <p class="text-gray-600">أخبرنا عن أهدافك الصحية وتفضيلاتك الغذائية.</p>
                    </div>
                    <div
                        class="text-center p-4 border-t-2 border-b-2 md:border-t-0 md:border-b-0 md:border-l-2 md:border-r-2 border-brand-light py-8 md:py-4">
                        <div class="text-5xl text-brand mb-4">2</div>
                        <h3 class="text-xl font-semibold mb-2">احصل على خطتك</h3>
                        <p class="text-gray-600">استلم خطة غذائية مخصصة ووصفات تناسبك.</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-5xl text-brand mb-4">3</div>
                        <h3 class="text-xl font-semibold mb-2">تابع تقدمك</h3>
                        <p class="text-gray-600">استخدم أدواتنا وحقق نتائج ملموسة.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('components.web.footer')

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!menu.contains(e.target) && !btn.contains(e.target) && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });

        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                setTimeout(() => {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                }, 100);
            });
        });
    </script>

</body>

</html>
