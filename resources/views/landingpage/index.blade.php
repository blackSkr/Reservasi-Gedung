<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Gedung | Pams</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="logo-web-2.svg">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-building text-primary-500 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">Sewa Gedung | Pams</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#buildings" class="relative text-gray-700 hover:text-primary-600 px-3 py-2 text-sm font-medium after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-500 after:transition-all after:duration-300 hover:after:w-full">Daftar Gedung</a>
                    <a href="#features" class="relative text-gray-700 hover:text-primary-600 px-3 py-2 text-sm font-medium after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-500 after:transition-all after:duration-300 hover:after:w-full">Benefit</a>
                    <a href="#testimonials" class="relative text-gray-700 hover:text-primary-600 px-3 py-2 text-sm font-medium after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-500 after:transition-all after:duration-300 hover:after:w-full">Testimoni</a>
                    <a href="#contact" class="relative text-gray-700 hover:text-primary-600 px-3 py-2 text-sm font-medium after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-500 after:transition-all after:duration-300 hover:after:w-full">Kontak</a>
                    {{-- <a href="/login" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">Login</a> --}}
                    {{-- <a href="{{ route('filament.admin.auth.login') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">Login</a> --}}
                </div>
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#buildings" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50">Daftar gedung</a>
                <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50">Benefit</a>
                <a href="#testimonials" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50">Testimon</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50">Kontak</a>
                <a href="{{ route('filament.admin.auth.register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-primary-600 hover:bg-primary-700">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center min-h-screen flex items-center"  style="background-image: url('{{ asset('storage/assets/background/ombak-6.svg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-0"></div>
        <div class="absolute bottom-0 left-0 right-0 h-24"
         style="background: linear-gradient(to bottom, rgba(255, 255, 205, 0) 0%, #ffffff 100%);">
         </div>
            <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 text-gray">
            <div class="md:flex items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Bingung mau Nyewa Gedung?</h1>
                    <p class="text-xl mb-8">Dengan Kami Saja!</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#buildings" class="bg-white text-primary-600 hover:bg-gray-100 px-6 py-3 rounded-md text-lg font-medium text-center transition duration-300">Temukan Gedung</a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    
                    <img src="{{ asset('storage/assets/background/orang-bingung-2.svg') }}" alt="Modern building interior" class="rounded-lg max-w-full h-auto">
                </div>
            </div>
            </div>
        </div>
    </section>
    

    <!-- Stats Section -->
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <div class="text-4xl font-bold text-primary-600 mb-2">{{$totalgedung}}</div>
                    <div class="text-gray-600">Gedung</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-primary-600 mb-2">{{$totalreservasitampil}}</div>
                    <div class="text-gray-600">Reservasi berhasil</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-primary-600 mb-2">24/7</div>
                    <div class="text-gray-600">Customer Service</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-primary-600 mb-2">100%</div>
                    <div class="text-gray-600">Garansi Uang Kembali</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Buildings Section -->
    <section id="buildings" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Gedung Yang Kami Tawarkan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Gunakan Kesempatan Tersebut !</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(
                    $gedungs->where('status', 'ready') as $gedung)

                <!-- Building Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 hover:-translate-y-1">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $gedung->foto_gedung) }}" alt="{{ $gedung->nama_gedung }}" class="w-full h-64 object-cover">
                        {{-- <div class="absolute top-4 right-4 bg-primary-600 text-white px-3 py-1 rounded-full text-sm font-medium">Popular</div> --}}
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $gedung->nama_gedung }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Kapasitas : {{ $gedung->kapasitas }} Orang</span>
                        </div>
                        {{-- <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Downtown Business District</span>
                        </div> --}}
                        <p class="text-gray-600 mb-4">{{ Illuminate\Support\Str::limit($gedung->deskripsi, 25) }}</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-xl font-bold text-gray-900 font-variant-numeric: decimal;">Rp {{ number_format($gedung->harga, 0, ',', '.') }}</span>
                                <span class="text-gray-600"> / 12 Jam</span>
                            </div>
                            <a href="{{ route('filament.admin.auth.register') }}">
                                <button class="bg-primary-600 hover:bg-primary-700 text-white px-2 py-2 rounded-md text-sm font-medium transition duration-300">
                                    Reservasi Sekarang
                                </button>
                            </a>
                            {{-- <button onclick="openReservationModal('Grand Conference Center')" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">Reservasi Sekarang</button> --}}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 transition duration-300">
                    Lihat Semua
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Sih Harus Sewa Gedung Kami?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Fleksible, Efisien dan Terjangkau</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Resrvasi Mudah</h3>
                    <p class="text-gray-600">Kami bisa bantu kamu nemuin tanggal yang cocok</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Terjangkau</h3>
                    <p class="text-gray-600">Kami juga nyiapin bundling yang "Worth To Buy" untuk kalian</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Mudah Untuk Komunikasi</h3>
                    <p class="text-gray-600">24/7 Kami untuk kalian !</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Testimoni Tentang Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto"></p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ulasans->where('status', 'Tampil') as $ulasan)                    
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            {{-- {{  }} --}}
                            <img class="h-10 w-10 rounded-full" src="https://cdn-icons-png.flaticon.com/512/9815/9815472.png" alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $ulasan->user->nama }}</div>
                            <div class="text-sm text-gray-500">{{$ulasan->user->email}}</div>
                        </div>
                    </div>
                        <p class="text-gray-600 italic">"{{ Illuminate\Support\Str::limit($ulasan->ulasan, 5) }}"</p>
                    <div class="mt-4 flex text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $ulasan->bintang)
                                <svg class="w-5 h-5 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.4 12.545 1 8.91l6.09-.91L10 2l2.91 6 6.09.91-4.4 3.635 1.278 5.545z"/></svg>
                            @else
                                <svg class="w-5 h-5 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.4 12.545 1 8.91l6.09-.91L10 2l2.91 6 6.09.91-4.4 3.635 1.278 5.545z"/></svg>
                            @endif
                        @endfor
                    </div>                    
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Udah Kepikiran booking Gedung Yang Mana Nih?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Cusss Reservasi Yaaa</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="#buildings" class="bg-white text-primary-600 hover:bg-gray-100 px-6 py-3 rounded-md text-lg font-medium transition duration-300">Cek Gedung</a>
                {{-- <a href="/contact" class="border-2 border-white text-white hover:bg-white hover:text-primary-600 px-6 py-3 rounded-md text-lg font-medium transition duration-300">Contact Us</a> --}}
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Kontak Kami</h2>
                    <p class="text-gray-600 mb-8">Jika ada pertanyaan, kritik dan saran, kami sangat terbuka</p>
                    @foreach ($profil_perusahaans as $profil_perusahaan)                        
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-primary-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-600">
                                <p>{{$profil_perusahaan->nama_perusahaan}}</p>
                                <p>{{$profil_perusahaan->alamat_jalan}}, {{$profil_perusahaan->alamat_gedung}}</p>
                                <p>{{$profil_perusahaan->kota}}, {{$profil_perusahaan->provinsi}}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-primary-600">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-600">
                                <p>{{$profil_perusahaan->nomor_telepon}}</p>
                                <p>Senin-Jumat, 08.00 - 16.30 WITA</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-primary-600">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="ml-3 text-base text-gray-600">
                                <p>{{$profil_perusahaan->email}}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex space-x-6">
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary-600">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
                
                {{-- <div>
                    <form class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <select id="subject" name="subject" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>General Inquiry</option>
                                <option>Reservation Question</option>
                                <option>Pricing Information</option>
                                <option>Technical Support</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500"></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-10 md:grid-cols-4 gap-8">
                {{-- <div>
                    <h3 class="text-lg font-semibold mb-4">BuildingReserve</h3>
                    <p class="text-gray-400">Premium venues for every occasion. Book your perfect space with confidence.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#buildings" class="text-gray-400 hover:text-white transition duration-300">Our Buildings</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition duration-300">Features</a></li>
                        <li><a href="#testimonials" class="text-gray-400 hover:text-white transition duration-300">Testimonials</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div> --}}
                
                {{-- <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Cancellation Policy</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new buildings and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-md focus:outline-none text-gray-900">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 px-4 py-2 rounded-r-md transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div> --}}
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2023 Pams.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Reservation Modal -->
    {{-- <div id="reservation-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-screen overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900" id="modal-building-name">Reserve Building</h3>
                    <button onclick="closeReservationModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="space-y-4">
                    <div>
                        <label for="reservation-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="reservation-name" name="reservation-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    
                    <div>
                        <label for="reservation-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="reservation-email" name="reservation-email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    
                    <div>
                        <label for="reservation-phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="reservation-phone" name="reservation-phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="reservation-date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" id="reservation-date" name="reservation-date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div>
                            <label for="reservation-time" class="block text-sm font-medium text-gray-700">Time</label>
                            <select id="reservation-time" name="reservation-time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option>9:00 AM</option>
                                <option>10:00 AM</option>
                                <option>11:00 AM</option>
                                <option>12:00 PM</option>
                                <option>1:00 PM</option>
                                <option>2:00 PM</option>
                                <option>3:00 PM</option>
                                <option>4:00 PM</option>
                                <option>5:00 PM</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="reservation-duration" class="block text-sm font-medium text-gray-700">Duration</label>
                        <select id="reservation-duration" name="reservation-duration" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                            <option>1 hour</option>
                            <option>2 hours</option>
                            <option>4 hours</option>
                            <option>Full day (8 hours)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="reservation-notes" class="block text-sm font-medium text-gray-700">Special Requests</label>
                        <textarea id="reservation-notes" name="reservation-notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500"></textarea>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-300">
                            Submit Reservation Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });

        // Reservation modal functions
        function openReservationModal(buildingName) {
            document.getElementById('modal-building-name').textContent = `Reserve ${buildingName}`;
            document.getElementById('reservation-modal').classList.remove('opacity-0', 'invisible');
            document.getElementById('reservation-modal').classList.add('opacity-100', 'visible');
            document.body.style.overflow = 'hidden';
        }

        function closeReservationModal() {
            document.getElementById('reservation-modal').classList.remove('opacity-100', 'visible');
            document.getElementById('reservation-modal').classList.add('opacity-0', 'invisible');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('reservation-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReservationModal();
            }
        });

        // Form submission handling (would be replaced with actual form submission to Laravel backend)
        document.querySelector('#reservation-modal form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Reservation request submitted! In a real implementation, this would connect to your Laravel backend.');
            closeReservationModal();
        });
    </script>
</body>
</html>