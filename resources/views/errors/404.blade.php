{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        /* .glow {
            text-shadow: 0 0 10px rgba(96, 165, 250, 0.7);
        } */
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-blue-900 min-h-screen flex items-center justify-center text-white p-4">
    <div class="max-w-4xl mx-auto text-center">
        <div class="floating mb-12">
            <div class="text-9xl font-bold glow mb-4">404</div>
            <div class="text-5xl font-semibold mb-6">Oops! Kok Sampe Sini? Balik Yuk</div>
            <p class="text-xl text-blue-200 max-w-2xl mx-auto mb-10">
                Halaman Web yang kamu cari ga ada nih
            </p>
            
            <div class="relative group">
                <button onclick="window.location.href='/'" class="relative px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-full text-lg font-bold transition-all duration-300 transform group-hover:scale-105 overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i> Kembali ke halaman awal
                    </span>
                    {{-- <span class="absolute inset-0 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span> --}}
                </button>
                {{-- <div class="absolute -inset-2 bg-blue-500 rounded-full blur-lg opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div> --}}
            </div>
            
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- <div class="p-4 bg-blue-900/30 rounded-xl hover:bg-blue-800/50 transition-colors cursor-pointer" onclick="window.location.href='/about'">
                    <i class="fas fa-info-circle text-3xl mb-2"></i>
                    <div>About Us</div>
                </div>
                <div class="p-4 bg-blue-900/30 rounded-xl hover:bg-blue-800/50 transition-colors cursor-pointer" onclick="window.location.href='/contact'">
                    <i class="fas fa-envelope text-3xl mb-2"></i>
                    <div>Contact</div>
                </div>
                <div class="p-4 bg-blue-900/30 rounded-xl hover:bg-blue-800/50 transition-colors cursor-pointer" onclick="window.location.href='/blog'">
                    <i class="fas fa-newspaper text-3xl mb-2"></i>
                    <div>Blog</div>
                </div>
                <div class="p-4 bg-blue-900/30 rounded-xl hover:bg-blue-800/50 transition-colors cursor-pointer" onclick="window.location.href='/help'">
                    <i class="fas fa-question-circle text-3xl mb-2"></i>
                    <div>Help</div>
                </div> --}}
            </div>
        </div>
        
        <div class="absolute bottom-6 left-0 right-0 text-center text-blue-300 text-sm">
            {{-- <p>Still lost? <a href="/contact" class="text-blue-400 hover:underline">Contact our support team</a></p> --}}
        </div>
    </div>

    <script>
        // Add a fun confetti effect when clicking the home button
        document.querySelector('button').addEventListener('click', function() {
            // Create confetti elements
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'absolute w-2 h-2 bg-blue-400 rounded-full';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = '0';
                confetti.style.opacity = Math.random();
                document.body.appendChild(confetti);
                
                // Animate confetti
                const duration = Math.random() * 3000 + 1000;
                confetti.animate([
                    { top: '0', transform: 'rotate(0deg)' },
                    { top: '100vh', transform: 'rotate(360deg)' }
                ], {
                    duration: duration,
                    easing: 'cubic-bezier(0.1, 0.8, 0.9, 1)'
                });
                
                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, duration);
            }
            
            // Small delay before redirecting
            setTimeout(() => {
                window.location.href = '/';
            }, 500);
        });
    </script>
</body>
</html>