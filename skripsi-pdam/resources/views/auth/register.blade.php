<div id="createModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="w-full max-w-3xl bg-white p-10 rounded-xl shadow-lg">
        <div class="flex justify-between">
            <h2 class="text-3xl font-bold text-center text-indigo-700 mb-8">Daftar Akun Baru</h2>
            <button id="closeBtn">
                X
            </button>
        </div>

        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid Form -->
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('no_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="peran" class="block text-sm font-medium text-gray-700">Peran</label>
                    <select id="peran" name="peran" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih peran</option>
                        <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teknisi" {{ old('peran') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="pelanggan" {{ old('peran') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                    @error('peran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Foto Profil -->
            <div class="mb-6">
                <label for="foto_profil" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <input type="file" id="foto_profil" name="foto_profil" accept="image/*" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-white" />
                @error('foto_profil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Daftar
                </button>
            </div>

            <!-- Login link -->
            <div class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login di sini</a>
            </div>
        </form>
    </div>
</div>