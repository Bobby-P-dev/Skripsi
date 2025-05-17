<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Start -->
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required />
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" required />
                @error('no_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" required />
                @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="peran">Peran</label>
                <select id="peran" name="peran" required>
                    <option value="">Pilih peran</option>
                    <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teknisi" {{ old('peran') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                    <option value="pelanggan" {{ old('peran') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
                @error('peran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" required />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-center w-full mb-6">
            <label for="foto_profil" class="cursor-pointer">
                <p class="text-sm text-gray-500">Upload Foto Profil</p>
                <input id="foto_profil" name="foto_profil" type="file" accept="image/*" class="hidden" required />
            </label>
            @error('foto_profil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <button type="submit" class="btn btn-primary w-full">Submit</button>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-blue-600" href="{{ route('login') }}">
                {{ __('Sudah punya akun? Login') }}
            </a>
        </div>
    </form>
</body>

</html>