<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="relative h-screen flex flex-row sm:justify-center items-center sm:pt-0">
        <!-- Background Blur -->
        <div class="absolute inset-0 bg-cover bg-center blur-md" style="background-image: url('{{ asset('images/tirta-bg.jpeg') }}'); z-index: -1;"></div>

        <div class="sm:max-md flex flex-row sm:justify-center items-center mt-6 px-6 py-4 bg-sky-200 bg-opacity-70 shadow-md overflow-hidden sm:rounded-xl backdrop-blur-md">

            <!-- kiri login -->
            <div class="w-full sm:max-w-md mt-6 px-6 mx-10 py-4 overflow-hidden sm:rounded-xl">
                <!-- Logo -->
                <div class="flex justify-center items-center">
                    <a href="/login">
                        <img src="{{ asset('images/tirta.png') }}" alt="Tirta.png" class="w-60 h-70">
                    </a>
                </div>
            </div>

            <!-- kanan login -->
            <div class="w-full sm:max-w-md mt-6 px-6 mx-10 py-4 overflow-hidden sm:rounded-xl">
                <!-- Judul -->
                <div class="text-center">
                    <h6 class="text-3xl font-bold text-gray-900 font-fomo">Masuk ke Akun Anda</h6>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" class="mt-2">
                    @csrf

                    <!-- Email -->
                    <div class="py-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 block w-full border-b-2 rounded-xl shadow-sm sm:text-sm @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="py-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full border-b-2 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-500 @enderror">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
