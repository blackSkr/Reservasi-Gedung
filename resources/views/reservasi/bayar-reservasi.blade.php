<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Payment Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .qr-container {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .info-item {
            transition: all 0.3s ease;
        }
        .info-item:hover {
            transform: translateX(5px);
        }
        .copy-btn {
            transition: all 0.2s ease;
        }
        .copy-btn:hover {
            background-color: #e5e7eb;
        }
        .copy-btn:active {
            transform: scale(0.95);
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    
    <!-- QR Payment Container -->
    <div class="bg-white rounded-2xl overflow-hidden w-full max-w-4xl flex flex-col md:flex-row shadow-xl">
        
        <!-- QR Code Section -->
        <div class="w-full md:w-1/2 p-8 flex flex-col items-center justify-center bg-gray-50">
            <div class="qr-container bg-white p-6 rounded-lg mb-6 pulse">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://example.com/payment/123456" 
                     alt="QR Code" 
                     class="w-48 h-48 mx-auto">
            </div>
            
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Download / langsung Scan ya!</h3>
                <p class="text-sm text-gray-500">{{ $reservation->batas_waktu_reservasi}}</p>
                
                <div class="mt-6 flex items-center justify-center space-x-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-blue-500"></i>
                    </div>
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fab fa-whatsapp text-green-500"></i>
                    </div>
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fab fa-facebook-messenger text-purple-500"></i>
                    </div>
                    
                </div>
                <div class="mt-4 text-center">
                    <img id="previewImage" class="hidden mx-auto rounded-lg max-h-60 border border-gray-300 shadow-sm" />
                </div>
            </div>
        </div>
        
        <!-- Payment Information Section -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Payment Details</h2>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
            
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="space-y-5">
                <div class="info-item bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500">Reservasi Id</p>
                            <p class="font-medium">{{$reservation->id}}</p>
                        </div>
                        <button class="copy-btn p-2 rounded-full text-gray-500 hover:text-gray-700">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                </div>
                
                <div class="info-item bg-gray-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-gray-500">Customer Name</p>
                        <p class="font-medium">{{$reservation->user->nama}}</p>
                    </div>
                </div>
                
                <div class="info-item bg-gray-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-gray-500">Building</p>
                        <p class="font-medium">{{ $reservation->gedung->nama_gedung }}</p>
                    </div>
                </div>
                
                <div class="info-item bg-gray-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-gray-500">Check-in Date</p>
                        <p class="font-medium">{{ $reservation->waktu_mulai }}</p>
                    </div>
                </div>
                
                <div class="info-item bg-gray-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-gray-500">Check-out Date</p>
                        <p class="font-medium">{{ $reservation->waktu_selesai }}</p>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4 mt-6">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-gray-600">Harga Sewa</p>
                        <p class="font-medium">Rp {{ number_format($reservation->nominal, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-gray-600"> Tambahan {{$reservation->fasilitas->nama_fasilitas ?? '-'}}</p>
                        <p class="font-medium">    Rp {{ number_format($reservation->fasilitas?->harga ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg mt-4">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-bold text-blue-800">Total Bayar</p>
                        <p class="text-2xl font-bold text-blue-800">Rp {{ number_format($reservation->total_reservasi, 0, ',', '.') }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('reservasi.bayar', $reservation->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-center w-full">
                        <label for="bukti_pembayaran" id="dropzone-label"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 transition hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Kirim Bukti bayar Disini ya</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 2MB)</p>
                            </div>
                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" accept="image/*" class="hidden" required />
                        </label>
                    </div>
                
                    <!-- Preview Gambar -->

                
                    <div class="mt-6">
                        <button id="paymentBtn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Kirim</span>
                        </button>
                    </div>
                </form>
                
                
                <p class="text-xs text-gray-500 text-center mt-4">
                    Payment will be processed within 1x24 hours after you complete the payment
                </p>
            </div>
        </div>
    </div>


    
    <script>
        // Trigger input file ketika label diklik
        document.getElementById('dropzone-label').addEventListener('click', function () {
            document.getElementById('bukti_pembayaran').click();
        });
    
        // Preview Gambar
        document.getElementById('bukti_pembayaran').addEventListener('change', function () {
            const file = this.files[0];
            const preview = document.getElementById('previewImage');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        });
    
        // Tombol submit dengan loading effect
        // const paymentBtn = document.getElementById('paymentBtn');
        // paymentBtn.addEventListener('click', () => {
        //     paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span> Processing...</span>';
        //     paymentBtn.disabled = true;
        // });
    </script>
    
</body>
</html>