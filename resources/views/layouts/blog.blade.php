<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <style>
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
    <nav class="bg-white py-2 fixed w-full z-50" id="navbar" x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <!-- Logo Sekolah -->
                        <div class="flex items-center">
                            <svg class="h-10 w-10 text-slate-800" viewBox="0 0 40 40" fill="currentColor">
                                <path
                                    d="M20 2L4 10l16 8 16-8-16-8zM4 22l16 8 16-8-4-2-12 6-12-6-4 2zM4 30l16 8 16-8-4-2-12 6-12-6-4 2z" />
                            </svg>
                            <span class="ml-2 text-slate-800 text-xl font-bold">SMP Cendekia</span>
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
                    <h3 class="text-xl font-bold mb-4">SMP Cendekia</h3>
                    <p class="text-gray-300">Membentuk generasi unggul yang berakhlak mulia, berprestasi, dan berwawasan
                        global.</p>
                </div>
                <div id="kontak">
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>Jl. Pendidikan No. 123</li>
                        <li>Telp: (021) 1234-5678</li>
                        <li>Email: info@smpcendekia.sch.id</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Link Cepat</h3>
                    <ul class="space-y-2">
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
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.061a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.548l-.047-.02z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-transform duration-500 hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057.246 1.17.07 4.85.07 6.364 0 7.634-.055 8.804-.07 2.227-.415.562-.217.96-.477 1.382-.896.419-.42.679-.819.896-1.381.164-.422.36-1.057.413-2.227.057-1.266.07-1.646.07-4.85s-.015-3.585-.074-4.85c-.061-1.17-.256-1.805-.421-2.227-.224-.562-.479-.96-.899-1.382-.419-.419-.824-.679-1.38-.896-.42-.164-1.065-.36-2.235-.413-1.274-.057-1.649-.07-4.859-.07-3.211 0-3.586.015-4.859.074-1.171.061-1.816.256-2.236.421-.569.224-.96.479-1.379.899-.421.419-.69.824-.9 1.38-.165.42-.359 1.065-.42 2.235-.045 1.27-.06 1.655-.06 4.859 0 3.189.016 3.586.074 4.859.061 1.17.255 1.816.421 2.236.224.569.479.96.9 1.379.419.419.81.689 1.379.898.42.165 1.065.36 2.235.421 1.27.045 1.655.06 4.859.06 3.189 0 3.586-.016 4.859-.074 1.17-.061 1.816-.256 2.236-.421.569-.224.96-.479 1.379-.899.419-.419.689-.81.898-1.379.165-.42.36-1.065.421-2.235.045-1.27.06-1.655.06-4.859 0-3.189-.016-3.586-.074-4.859-.061-1.17-.256-1.816-.421-2.236-.224-.569-.479-.96-.899-1.379-.419-.419-.81-.689-1.379-.898-.42-.165-1.065-.36-2.235-.421C15.585 2.176 15.19 2.161 12 2.161z" />
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
                <p>&copy; 2024 SMP Cendekia. All rights reserved.</p>
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