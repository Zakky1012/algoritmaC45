<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promortion UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%); }
        .card-shadow { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">

    <!-- Alert Messages -->
@if(session('success'))
<div class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3 animate-fade-in-down">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3 animate-fade-in-down">
    <i class="fas fa-times-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif
    <div class="w-full max-w-5xl bg-white rounded-3xl overflow-hidden card-shadow flex flex-col lg:flex-row min-h-[600px]">
        
<!-- Left Section -->
<div class="flex-1 bg-gradient-to-br from-indigo-500 via-purple-500 to-purple-600 p-8 lg:p-12 flex flex-col justify-center text-white relative">
    <div class="mb-12">
        <div class="flex items-center gap-3">
            <div class="w-7 h-7 bg-white bg-opacity-20 rounded-lg flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-5 h-5 object-contain">
            </div>
            <span class="text-xl font-medium">Promosi umkm</span>
        </div>
    </div>
    
    <div class="mb-16">
        <h1 class="text-4xl font-bold mb-6 leading-tight">Selamat Datang!</h1>
        <div class="space-y-2 mb-10">
            <p class="text-xl font-medium">Repeh rapih kertaraharja</p>
            <p class="text-base opacity-90">Masuk untuk bisa melihat promosi</p>
        </div>
    </div>
    
    <div class="mt-auto">
        <p class="text-base mb-4 opacity-90">Belum punya akun?</p>
        <a href="{{ route('register') }}" 
           class="px-6 py-2 border-2 border-white border-opacity-60 rounded-full text-sm text-white font-medium hover:bg-white hover:text-purple-600 transition-all duration-300">
           Daftar Sekarang
        </a>
        <a href="{{ url('/') }}" 
        class="px-6 py-2 border-2 border-white border-opacity-60 rounded-full text-sm text-white font-medium hover:bg-white hover:text-purple-600 transition-all duration-300">
        Home
     </a>
    </div>
</div>

        <!-- Right Section - Login Form -->
        <div class="flex-1 p-8 lg:p-12 flex flex-col justify-center">
            <div class="max-w-sm mx-auto w-full">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 tracking-wide">SIGN IN</h2>
                </div>
                
                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                   
                    
                    <!-- Submit -->
                    <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-semibold hover:bg-purple-700 transition text-lg">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
