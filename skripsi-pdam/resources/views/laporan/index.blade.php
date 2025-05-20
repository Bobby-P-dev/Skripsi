<x-home>
    <div class="container mx-auto px-4 py-4">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Kerusakan</h1>
            @if (auth()->user()->peran === 'pelanggan')
            <button id="openModalBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Buat Laporan
            </button>
            @endif
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @if($laporans && count($laporans) > 0)
            @foreach ($laporans as $laporan)
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                @if(!empty($laporan->foto_url))
                <img src="{{ $laporan->foto_url }}"
                    alt="Gambar Laporan"
                    class="w-full h-48 object-cover cursor-pointer previewable"
                    data-src="{{ $laporan->foto_url }}">

                @else
                <img src="{{ asset('images/tirta.png') }}"
                    alt="Gambar Laporan"
                    class="w-full h-48 object-cover cursor-pointer previewable"
                    data-src="{{ asset('images/tirta.png') }}">

                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $laporan->judul }}</h2>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $laporan->lokasi }}</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{$laporan->deskripsi}}
                    </p>

                    <p class="text-gray-600 text-sm mb-4">
                        {{$laporan->tingkat_urgensi}}
                    </p>

                    <p class="text-gray-600 text-sm mb-4">
                        {{$laporan->status}}
                    </p>
                    <a href="#"
                        class="inline-block text-sm text-indigo-600 font-medium hover:underline">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @endforeach
            @else
            <p>Data Belum Ada</p>
            @endif

        </div>

    </div>

    @include('laporan.preview-image')
    @include('laporan.create')
    <script>
        //add modal
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('buatLaporanModal');

        openBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });


        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

        //preview gambar
        const previewModal = document.getElementById('imagePreviewModal');
        const previewImg = document.getElementById('previewImage');
        const closePreview = document.getElementById('closeImagePreview');

        document.querySelectorAll('.previewable').forEach(img => {
            img.addEventListener('click', () => {
                previewImg.src = img.getAttribute('data-src');
                previewModal.classList.remove('hidden');
                previewModal.classList.add('flex');
            });
        });

        closePreview.addEventListener('click', () => {
            previewModal.classList.add('hidden');
            previewModal.classList.remove('flex');
        });

        previewModal.addEventListener('click', (e) => {
            if (e.target === previewModal) {
                previewModal.classList.add('hidden');
                previewModal.classList.remove('flex');
            }
        });
    </script>

</x-home>