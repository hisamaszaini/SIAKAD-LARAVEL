<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="{{ asset('/js/alpine.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/aos.css') }}" />
    <script src="{{ asset('/js/aos.js') }}"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <style>
        body {
            font-family: 'Open Sans';
            font-size: 18px !important;
            line-height: 24px;
            font-weight: 400;
        }
        .mt-min {
            margin-top: -70px;
        }

        .hover-scale {
            transition: transform;
            transition-duration: 500ms;
        }

        .hover-scale:hover {
            transform: scale(1.05) !important;
        }
    </style>
    <script>
        module.exports = {
            theme: {
                extend: {},
            },
            plugins: [],
            variants: {
                extend: {
                    transform: ['hover'],
                    scale: ['hover'],
                }
            }
        }
    </script>
</head>

<body class="font-sans">
    <!-- Navbar -->
    <nav class="bg-white fixed w-full z-50 border-b border-blue-200 py-2" id="navbar" x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <a href="/"><img src="{{ asset('/storage/logo/sekolah_logo.png') }}" alt="Logo {{ $settings->lembaga_nama }}" class="w-16 h-16 inline-block">
                            <span class="ml-2 my-auto text-slate-800 text-xl font-bold">{{ $settings->lembaga_nama }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('blog.index') }}"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Beranda</a>
                        <a href="#"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Profil</a>
                        <a href="#"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Akademik</a>
                        <a href="#"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Fasilitas</a>
                        <a href="#"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">PPDB</a>
                        <a href="#kontak"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Kontak</a>
                        <a href="{{ route('login') }}"
                            class="text-slate-800 hover:text-emerald-600 px-3 py-2 rounded-md text-md font-medium">Login</a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="isOpen = !isOpen" class="text-slate-800 hover:text-emerald-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="isOpen" class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Profil</a>
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Akademik</a>
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Fasilitas</a>
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">PPDB</a>
                    <a href="#"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
                    <a href="{{ route('login') }}"
                        class="text-slate-800 hover:text-emerald-500 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Login</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">{{ $settings->lembaga_nama }}</h3>
                    <p class="text-gray-300">Membentuk generasi unggul yang berakhlak mulia, berprestasi, dan berwawasan
                        global.</p>
                </div>
                <div id="kontak">
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>{{ $settings->lembaga_jalan }}</li>
                        <li>Telp: {{ $settings->lembaga_telp }}</li>
                        <li>Email: info@smpcendekia.sch.id</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Link Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login {{ $settings->app_namapendek }}</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">PPDB Online</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">E-Learning</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Perpustakaan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Alumni</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-transform duration-500 hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-transform duration-500 hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-blue-800 text-center text-gray-300">
                <p>&copy; 2024 {{ $settings->lembaga_nama }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop"
        class="fixed bottom-4 right-4 bg-blue-600 text-white p-2 rounded-full shadow-lg hidden hover:bg-blue-700 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <!-- Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Slider Automation
        setInterval(() => {
            let currentSlide = parseInt(document.querySelector('[x-data]').__x.$data.activeSlide);
            document.querySelector('[x-data]').__x.$data.activeSlide = currentSlide === 3 ? 1 : currentSlide + 1;
        }, 5000);

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.onscroll = function() {
            var navbar = document.getElementById("navbar");
            if (navbar) {
                if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                    navbar.classList.add("py-1", "bg-opacity-80");
                    navbar.classList.remove("py-2");
                } else {
                    navbar.classList.remove("py-1", "bg-opacity-80");
                    navbar.classList.add("py-2");
                }
            }
        };

        // Mobile Menu Animation
        document.querySelector('[x-data]').__x.$data.isOpen = false;
    </script>
</body>

</html>