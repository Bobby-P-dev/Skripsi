<div id="penugasan-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 overflow-y-auto">
    <div class="w-full max-w-2xl mx-4 my-10 bg-white rounded-xl shadow-xl overflow-hidden relative">

        <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-white">📝 Buat Penugasan</h2>
            <button id="closeModalBtn" class="text-white text-3xl font-bold hover:text-gray-200">&times;</button>
        </div>
        <div class="px-8 py-8">
            <form action="{{ route('penugasan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" id="data-laporan-uuid" name="laporan_uuid" value="" required>
                <input type="hidden" name="admin_id" value="{{ Auth::id() }}">

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="catatan"
                        id="catatan"
                        placeholder="Catatan untuk petugas"
                        required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                        @error('catatan') border-red-500 @enderror">
                    @error('catatan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="modalTenggatWaktu" class="block text-sm font-medium text-gray-700 mb-1">
                        Tenggat Waktu <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        id="modalTenggatWaktu"
                        name="tenggat_waktu"
                        value="{{ old('tenggat_waktu') }}"
                        required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                        @error('tenggat_waktu') border-red-500 @enderror">
                    @error('tenggat_waktu')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="alpineTeknisiId" class="block text-sm font-medium text-gray-700 mb-1">
                        Pilih Teknisi <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="alpineTeknisiId"
                        name="teknisi_id"
                        required
                        class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('teknisi_id') border-red-500 @enderror">
                        @if(isset($teknisi) && $teknisi->count() > 0)
                        @foreach ($teknisi as $teknisisaya)
                        <option value="{{ $teknisisaya->pengguna_id }}" {{ old('teknisi_id') == $teknisisaya->pengguna_id ? 'selected' : '' }}>
                            {{ $teknisisaya->nama }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    @error('teknisi_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg border border-indigo-500 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 px-5 py-2 text-sm font-semibold shadow transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Simpan Penugasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>