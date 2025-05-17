@extends('components.create-laporan')
<x-home>
    <main class="flex-1 overflow-y-auto p-8 bg-gray-50 min-h-screen">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold">Daftar Laporan</h2>
            <button onclick="openModal()" class="btn-primary">
                Buat Laporan Baru
            </button>
        </div>

        {{-- Grid card --}}
        @if(isset($laporans) && count($laporans) > 0)
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-left">No</th>
                    <th class="px-4 py-2 border-b text-left">Judul</th>
                    <th class="px-4 py-2 border-b text-left">Deskripsi</th>
                    <th class="px-4 py-2 border-b text-left">Lokasi</th>
                    <th class="px-4 py-2 border-b text-left">Tingkat Urgensi</th>
                    <th class="px-4 py-2 border-b text-left">Status</th>
                    <th class="px-4 py-2 border-b text-left">Tanggal</th>
                    <th class="px-4 py-2 border-b text-left">Foto</th>
                    <th class="px-4 py-2 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $index => $laporan)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $laporan->judul }}</td>
                    <td class="px-4 py-2 border-b">{{ \Illuminate\Support\Str::limit($laporan->deskripsi, 50) }}</td>
                    <td class="px-4 py-2 border-b">{{ $laporan->lokasi }}</td>
                    <td class="px-4 py-2 border-b">{{ $laporan->tingkat_urgensi }}</td>
                    <td class="px-4 py-2 border-b">{{ $laporan->status }}</td>
                    <td class="px-4 py-2 border-b">{{ $laporan->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border-b">
                        @if($laporan->foto_url)
                        <img src="{{ asset("storage/{$laporan->foto_url}") }}" alt="Foto" class="h-12 w-12 object-cover rounded">
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('laporan.index', $laporan->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center text-gray-500 py-8">
            Belum ada laporan.
        </div>
        @endif

        {{-- Modal form --}}
        <div id="laporanModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-center">Buat Laporan Baru</h2>
                <form class="flex flex-col items-center">
                    <input type="text" placeholder="Judul Laporan" class="w-full mb-3 p-2 border rounded" required>
                    <textarea placeholder="Isi Laporan" class="w-full mb-3 p-2 border rounded" required></textarea>
                    <input type="file" class="mb-3 block mx-auto" />
                    <button type="submit" class="btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function openModal() {
            document.getElementById('laporanModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('laporanModal').classList.add('hidden');
        }
        window.onclick = function(event) {
            const modal = document.getElementById('laporanModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</x-home>