<div id="penugasan-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 overflow-y-auto">
    <div class="w-full max-w-2xl mx-4 my-10 bg-white rounded-xl shadow-xl overflow-hidden relative">

        <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-white">📝 Buat Penugasan</h2>
            <button id="closeModalBtn" class="text-white text-3xl font-bold hover:text-gray-200">&times;</button>
        </div>
        <div>
            <form action="{{ route('penugasan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="text" class="hidden" id="data-laporan-uuid" name="laporan_uuid" value="" required>
                </div>
                <div>

                    <input type="text" name="admin_id" class="hidden" value="{{ Auth::id() }}">
                </div>
                <div>
                    <label for="catatan">Catatan</label>
                    <input type="text" class="" name="catatan" placeholder="Catatan untuk petugas" required>
                </div>
                <div class="mb-4">
                    <label for="modalTenggatWaktu" class="block text-sm font-medium text-gray-700 mb-1">
                        Tenggat Waktu <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
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

                <select id="alpineTeknisiId" name="teknisi_id" required
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('teknisi_id') border-red-500 @enderror">
                    @if(isset($laporanSaya['teknisi']) && $laporanSaya['teknisi']->count() > 0)
                    @foreach ($laporanSaya['teknisi'] as $teknisi)
                    <option value="{{ $teknisi->pengguna_id }}" {{ old('teknisi_id') == $teknisi->pengguna_id ? 'selected' : '' }}>
                        {{ $teknisi->nama }}
                    </option>
                    @endforeach
                    @else
                    @endif
                </select>
                <button type="submit" class="border rounded-xl">submit</button>
            </form>
        </div>
    </div>
</div>