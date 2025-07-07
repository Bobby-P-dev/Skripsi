<!-- Modal Register Akun -->
<div id="createModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="relative w-full max-w-3xl bg-white p-8 md:p-10 rounded-xl shadow-xl max-h-screen overflow-y-auto transition transform scale-100">

        <!-- Tombol Close -->
        <button id="closeBtn"
            class="absolute top-4 right-4 text-gray-600 hover:text-red-500 transition text-xl font-bold focus:outline-none"
            aria-label="Tutup">
            &times;
        </button>

        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 text-center mb-8">
            Daftar Akun Baru
        </h2>

        <!-- Form Register -->
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('nama') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" required placeholder="08xxxxxxxxxx"
                        autocomplete="tel"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('no_telepon') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required placeholder="Alamat lengkap"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('alamat') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="peran" class="block text-sm font-medium text-gray-700">Peran</label>
                    <select id="peran" name="peran" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih peran</option>
                        <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teknisi" {{ old('peran') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="pelanggan" {{ old('peran') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                    @error('peran') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required placeholder="contoh@email.com"
                    autocomplete="email"
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div>
                <label for="foto_profil" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <input type="file" id="foto_profil" name="foto_profil" accept="image/*" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-white file:mr-4 file:py-1 file:px-3 file:rounded file:border-none file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition" />
                @error('foto_profil') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Daftar
                </button>
            </div>

            <div class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login di sini</a>
            </div>
        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('createModal');
        const openBtn = document.getElementById('openRegisterModal');
        const closeBtn = document.getElementById('closeBtn');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        }
    });
</script>
