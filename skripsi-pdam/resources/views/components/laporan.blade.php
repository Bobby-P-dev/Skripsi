<x-home>
    <div class="container mx-auto px-4 py-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1>

        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 text-white px-4 py-2 font-semibold shadow hover:bg-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Laporan Baru
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-gray-200 text-gray-800 px-4 py-2 font-semibold shadow hover:bg-gray-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Lihat Panduan
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow flex items-center p-6 gap-4">
                <div class="bg-indigo-100 text-indigo-600 rounded-full p-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 20c0-2.21 3.582-4 6-4s6 1.79 6 4"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xl font-bold">174</div>
                    <div class="text-gray-500 text-sm">Pelanggan</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow flex items-center p-6 gap-4">
                <div class="bg-green-100 text-green-600 rounded-full p-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17l6-6 4 4 8-8"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xl font-bold">48</div>
                    <div class="text-gray-500 text-sm">Laporan Selesai</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow flex items-center p-6 gap-4">
                <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xl font-bold">12</div>
                    <div class="text-gray-500 text-sm">Laporan Proses</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow flex items-center p-6 gap-4">
                <div class="bg-red-100 text-red-600 rounded-full p-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xl font-bold">3</div>
                    <div class="text-gray-500 text-sm">Laporan Ditolak</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <div class="font-semibold text-gray-800 text-lg">Statistik Bulanan</div>
                    <form method="GET" action="" class="flex items-center gap-2">
                        <select name="bulan" class="border-gray-300 rounded-md text-sm pr-8 py-1 focus:border-indigo-500 focus:ring-indigo-500">
                            @php
                                $daftarBulan = [
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                ];
                                $selectedBulan = request('bulan', date('m'));
                                $selectedTahun = request('tahun', date('Y'));
                            @endphp
                            @foreach ($daftarBulan as $num => $nama)
                                <option value="{{ $num }}" {{ $selectedBulan == $num ? 'selected' : '' }}>
                                    {{ $nama }}
                                </option>
                            @endforeach
                        </select>
                        <select name="tahun" class="border-gray-300 rounded-md text-sm pr-8 py-1 focus:border-indigo-500 focus:ring-indigo-500">
                            @for ($th = date('Y'); $th >= date('Y')-4; $th--)
                                <option value="{{ $th }}" {{ $selectedTahun == $th ? 'selected' : '' }}>
                                    {{ $th }}
                                </option>
                            @endfor
                        </select>
                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded bg-indigo-600 text-white text-xs hover:bg-indigo-700 transition">
                            Filter
                        </button>
                    </form>
            </div>
            <div class="w-full h-40 flex items-center justify-center text-gray-400">
                <span>Bisa di isi grafik crypto ni bob</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="col-span-2 bg-white rounded-xl shadow p-6">
                <div class="mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m-4-5v9"/>
                    </svg>
                    <span class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</span>
                </div>
                <ul class="divide-y divide-gray-100">
                    <li class="py-3 flex items-center gap-3">
                        <span class="inline-block w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">MA</span>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-700">M. Andi</div>
                            <div class="text-sm text-gray-500">Mengajukan laporan "Pipa Bocor di Jalan Kenanga".</div>
                        </div>
                        <div class="text-xs text-gray-400">10 menit lalu</div>
                    </li>
                    <li class="py-3 flex items-center gap-3">
                        <span class="inline-block w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">NS</span>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-700">N. Sari</div>
                            <div class="text-sm text-gray-500">Laporan "Meter Air Macet" telah selesai.</div>
                        </div>
                        <div class="text-xs text-gray-400">30 menit lalu</div>
                    </li>
                    <li class="py-3 flex items-center gap-3">
                        <span class="inline-block w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-bold">TR</span>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-700">T. Rudi</div>
                            <div class="text-sm text-gray-500">Laporan "Gangguan Aliran" sedang diproses.</div>
                        </div>
                        <div class="text-xs text-gray-400">1 jam lalu</div>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col gap-4">
                <div class="mb-2 font-semibold text-gray-800 text-lg">Aksi Cepat</div>
                @can('create', App\Models\Pengguna_Model::class)
                <a href="{{ route('register') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-indigo-500 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 px-4 py-2 text-sm font-semibold shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pelanggan
                </a>
                @endcan
                <button class="inline-flex items-center gap-2 rounded-lg border border-green-500 bg-green-50 text-green-600 hover:bg-green-100 px-4 py-2 text-sm font-semibold shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17l6-6 4 4 8-8"/>
                    </svg>
                    Lihat Semua Laporan
                </button>
                <button class="inline-flex items-center gap-2 rounded-lg border border-yellow-500 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 px-4 py-2 text-sm font-semibold shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                    Laporan Diproses
                </button>
            </div>
        </div>
    </div>
</x-home>
