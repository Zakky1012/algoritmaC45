<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batuan Bertarget</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 50%, #3b82f6 100%);
        }
        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <div class="w-full max-w-3xl bg-white rounded-2xl overflow-hidden card-shadow flex flex-col lg:flex-row min-h-[500px]">
    
       <!-- Left Section -->
<div class="flex-1 bg-gradient-to-br from-purple-600 via-indigo-500 to-blue-600 p-6 lg:p-8 flex flex-col justify-center text-white">
    <div class="mb-8 flex items-center gap-2">
        <div class="w-7 h-7 bg-white bg-opacity-20 rounded-lg flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-5 h-5 object-contain">
        </div>
        
        <span class="text-lg font-medium">Bantuan Tepat Sasaran</span>
    </div>
    
    <h1 class="text-3xl font-bold mb-6">Daftar Akun</h1>
    <p class="text-base opacity-90 mb-8">
        Bergabunglah untuk memastikan program bantuan tersalurkan secara adil dan tepat sasaran.
    </p>
    
    <div class="mt-auto">
        <p class="text-base mb-4 opacity-90">Sudah punya akun?</p>
        <a href="{{ route('login') }}" 
           class="px-6 py-2 border-2 border-white border-opacity-60 rounded-full text-sm text-white font-medium hover:bg-white hover:text-purple-600 transition-all duration-300">
            Masuk
        </a>
    </div>
</div>
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
        <!-- Right Section - Register Form -->
        <div class="flex-1 p-6 lg:p-8 flex flex-col justify-center">
            <div class="max-w-xs mx-auto w-full">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">SIGN UP</h2>
                </div>
    
                <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
                    @csrf
    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                        <input type="text" name="name" class="w-full px-3 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
    
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
    
                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition text-gray-700" required>
                    </div>
    
                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                        <select name="role" class="w-full px-3 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 transition text-gray-700">
                            {{-- <option value="user">User</option> --}}
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
    
                    <!-- Submit -->
                    <button type="submit" class="w-full bg-purple-600 text-white py-2.5 rounded-lg font-semibold hover:bg-purple-700 transition text-base">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
