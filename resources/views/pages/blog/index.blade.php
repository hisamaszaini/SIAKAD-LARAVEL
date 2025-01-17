@extends('layouts.blog', ['title' => $title])

@section('content')
<!-- Hero/Slider Section -->
<div class="relative pt-16" x-data="{ 
        activeSlide: 1,
        initSlider() {
            setInterval(() => {
                this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1;
            }, 5000);
        }
    }" x-init="initSlider()">
    <div class="relative h-[600px] overflow-hidden">
        <!-- Slide 1 -->
        <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full" class="absolute inset-0 w-full h-full">
            <img src="{{ asset('storage/uploads/bg-gedung.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4" data-aos="fade-up">Selamat Datang di {{ $settings->lembaga_nama }}</h1>
                    <p class="text-xl md:text-2xl mb-8" data-aos="fade-up" data-aos-delay="200">Membentuk Generasi
                        Unggul dan Berakhlak Mulia</p>
                    <div data-aos="fade-up">
                        <a href="{{ route('login') }}" class="bg-green-600 transition-transform inline-block hover:bg-green-700 hover:scale-105 text-white font-bold py-3 px-8 rounded-full" data-aos-delay="400"> Login SIAKAD </a>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:scale-105 text-white font-bold py-3 px-8 rounded-full ml-1"
                            data-aos-delay="600">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full" class="absolute inset-0 w-full h-full">
            <img src="{{ asset('storage/uploads/bg-penyerahan-piala.webp') }}" alt="Slide 2" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Prestasi Gemilang</h1>
                    <p class="text-xl md:text-2xl mb-8">Raih Masa Depan Cerahmu Bersama Kami</p>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full" class="absolute inset-0 w-full h-full">
            <img src="{{ asset('storage/uploads/bg-lab-komputer.jpg') }}" alt="Slide 3" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Fasilitas Lengkap</h1>
                    <p class="text-xl md:text-2xl mb-8">Mendukung Pembelajaran Modern dan Inovatif</p>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="absolute top-1/2 left-4 transform -translate-y-1/2">
            <button @click="activeSlide = activeSlide === 1 ? 3 : activeSlide - 1"
                class="bg-white p-2 rounded-full shadow-lg hover:bg-gray-300 hover:scale-110 transition">
                <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>
        <div class="absolute top-1/2 right-4 transform -translate-y-1/2">
            <button @click="activeSlide = activeSlide === 3 ? 1 : activeSlide + 1"
                class="bg-white p-2 rounded-full shadow-lg hover:bg-gray-300 hover:scale-110 transition">
                <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>


<!-- Statistik Sekolah -->
<div class="mt-min bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center transition-transform" data-aos="fade-up">
            <div class="bg-white p-6 lg:p-8 sm:p-6 duration-500 transition-transform hover:scale-105 rounded-lg shadow-lg"
                data-aos-delay="100">
                <div class="text-4xl font-bold text-blue-600 mb-2 hover:scale-110">{{ $siswaCount }}</div>
                <div class="text-gray-600">Siswa Aktif</div>
            </div>
            <div class="bg-white p-6 lg:p-8 duration-500 transition-transform hover:scale-105 rounded-lg shadow-lg"
                data-aos-delay="150">
                <div class="text-4xl font-bold text-blue-600 mb-2 hover:scale-110">{{ $guruCount }}</div>
                <div class="text-gray-600">Guru & Staff</div>
            </div>
            <div class="bg-white p-6 lg:p-8 duration-500 transition-transform hover:scale-105 rounded-lg shadow-lg"
                data-aos-delay="200">
                <div class="text-4xl font-bold text-blue-600 mb-2 hover:scale-110">{{ $kelasCount }}</div>
                <div class="text-gray-600">Ruang Kelas</div>
            </div>
            <div class="bg-white p-6 lg:p-8 duration-500 transition-transform hover:scale-105 rounded-lg shadow-lg"
                data-aos-delay="250">
                <div class="text-4xl font-bold text-blue-600 mb-2 hover:scale-110">100%</div>
                <div class="text-gray-600">Kelulusan</div>
            </div>
        </div>
    </div>
</div>

<!-- Berita & Pengumuman -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-12">Berita & Pengumuman</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-aos="fade-up">
            <!-- Post 1 -->
            <div
                class="bg-white rounded-lg shadow-lg overflow-hidden duration-500 transition-transform hover:scale-105">
                <img src="https://picsum.photos/id/24/400/250" alt="Berita 1" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Juara Olimpiade Sains Nasional</h3>
                    <p class="text-gray-600 mb-4">Tim SMP Cendekia berhasil meraih medali emas dalam Olimpiade Sains
                        Nasional 2024...</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Baca selengkapnya →</a>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden duration-500 transition-transform hover:scale-105"
                data-aos-delay="100">
                <img src="https://picsum.photos/id/60/400/250" alt="Berita 2" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">PPDB 2024 Telah Dibuka</h3>
                    <p class="text-gray-600 mb-4">Pendaftaran peserta didik baru tahun ajaran 2024/2025 telah
                        dibuka. Segera daftarkan putra/putri Anda...</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Baca selengkapnya →</a>
                </div>
            </div>

            <!-- Post 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden duration-500 transition-transform hover:scale-105"
                data-aos-delay="200">
                <img src="https://picsum.photos/id/99/400/250" alt="Berita 3" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Prestasi di Bidang Seni</h3>
                    <p class="text-gray-600 mb-4">Grup paduan suara SMP Cendekia meraih juara 1 dalam Festival Seni
                        Pelajar tingkat Provinsi...</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Baca selengkapnya →</a>
                </div>
            </div>
        </div>

        <div class="pagination text-center mt-12" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('blog.list') }}"
                class="text-slate-200 font-medium p-3 bg-green-500 rounded-lg duration-500 inline-block transition-transform hover:text-white hover:bg-emerald-600 hover:scale-105">Post
                Sebelumnya</a>
        </div>
    </div>
</div>

<!-- Program Unggulan -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Program Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center" data-aos="fade-up">
                <div
                    class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <!-- Lanjutan Program Unggulan -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Program Akselerasi</h3>
                <p class="text-gray-600">Program khusus bagi siswa berbakat untuk menyelesaikan pendidikan lebih
                    cepat dengan kurikulum terstruktur.</p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div
                    class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">English Day</h3>
                <p class="text-gray-600">Program pembiasaan berbahasa Inggris untuk meningkatkan kemampuan
                    komunikasi internasional siswa.</p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div
                    class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Science Club</h3>
                <p class="text-gray-600">Klub sains untuk mengembangkan minat dan bakat siswa dalam bidang
                    penelitian dan eksperimen.</p>
            </div>
        </div>
    </div>
</div>

<!-- Galeri Kegiatan -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Galeri Kegiatan</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="relative overflow-hidden rounded-lg" data-aos="zoom-in">
                <img src="https://picsum.photos/id/225/300/300" alt="Kegiatan 1"
                    class="w-full h-64 object-cover hover:scale-110 transition duration-300">
            </div>
            <div class="relative overflow-hidden rounded-lg" data-aos="zoom-in" data-aos-delay="100">
                <img src="https://picsum.photos/id/250/300/300" alt="Kegiatan 2"
                    class="w-full h-64 object-cover hover:scale-110 transition duration-300">
            </div>
            <div class="relative overflow-hidden rounded-lg" data-aos="zoom-in" data-aos-delay="200">
                <img src="https://picsum.photos/id/260/300/300" alt="Kegiatan 3"
                    class="w-full h-64 object-cover hover:scale-110 transition duration-300">
            </div>
            <div class="relative overflow-hidden rounded-lg" data-aos="zoom-in" data-aos-delay="300">
                <img src="https://picsum.photos/id/268/300/300" alt="Kegiatan 4"
                    class="w-full h-64 object-cover hover:scale-110 transition duration-300">
            </div>
        </div>
    </div>
</div>

<!-- Testimonial -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Apa Kata Mereka?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale" data-aos="fade-up">
                <div class="flex items-center mb-4">
                    <img src="https://i.pravatar.cc/150?img=11" alt="Avatar" class="w-12 h-12 rounded-full">
                    <div class="ml-4">
                        <h4 class="font-bold">Ahmad Faiz</h4>
                        <p class="text-gray-600">Alumni 2023</p>
                    </div>
                </div>
                <p class="text-gray-600">"SMP Cendekia memberikan fondasi yang kuat untuk pendidikan saya. Guru-guru
                    yang kompeten dan fasilitas yang lengkap sangat membantu dalam proses belajar."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-4">
                    <img src="https://i.pravatar.cc/150?img=28" alt="Avatar" class="w-12 h-12 rounded-full">
                    <div class="ml-4">
                        <h4 class="font-bold">Siti Nur</h4>
                        <p class="text-gray-600">Orang Tua Siswa</p>
                    </div>
                </div>
                <p class="text-gray-600">"Anak saya mengalami perkembangan yang sangat baik selama bersekolah di
                    sini. Program-program sekolah sangat mendukung pengembangan karakter."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-4">
                    <img src="https://i.pravatar.cc/150?img=33" alt="Avatar" class="w-12 h-12 rounded-full">
                    <div class="ml-4">
                        <h4 class="font-bold">Budi Santoso</h4>
                        <p class="text-gray-600">Guru</p>
                    </div>
                </div>
                <p class="text-gray-600">"Lingkungan kerja yang supportif dan profesional membuat saya bersemangat
                    untuk terus mengajar dan mengembangkan diri."</p>
            </div>
        </div>
    </div>
</div>
@endsection