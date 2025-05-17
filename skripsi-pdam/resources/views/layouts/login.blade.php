<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PDAM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Background with Blur -->
    <div class="fixed inset-0 bg-cover bg-center blur-sm" style="background-image: url('{{ asset('images/tirta-bg.jpeg') }}'); z-index: -1;"></div>

    <div class="flex items-center justify-center min-h-screen relative z-10">
        <div class="w-full max-w-5xl bg-white bg-opacity-80 backdrop-blur-md rounded-2xl shadow-xl p-8 mx-4 lg:flex lg:gap-12">
            
            <!-- Left: Logo -->
            <div class="hidden lg:flex flex-col justify-center items-center w-full lg:w-1/2 px-6 py-4">
                <img src="{{ asset('images/tirta.png') }}" alt="Tirta.png" class="w-52 mb-6">
                <p class="text-gray-700 text-center text-lg font-semibold">Selamat datang di Sistem Informasi PDAM</p>
            </div>

            <!-- Mobile: Logo -->
            <div class="lg:hidden flex justify-center items-center w-full lg:w-1/2 px-6 py-4">
                <img src="{{ asset('images/tirta.png') }}" alt="Tirta.png" class="w-52 mb-6">
            </div>

            <!-- Right: Login Form -->
            <div class="w-full lg:w-1/2">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-indigo-700">Masuk ke Akun Anda</h1>
                    <p class="text-gray-600 text-sm mt-2">Silakan login untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                        @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 transition">
                            Masuk
                        </button>
                    </div>
                </form>

                <!-- Optional: Tambahan link -->
                <div class="text-center mt-4 text-sm text-gray-600">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar</a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
