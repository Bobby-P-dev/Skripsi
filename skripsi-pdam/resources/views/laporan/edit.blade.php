<div id="editLaporanModal" tabindex="-1" aria-labelledby="editLaporanModalLabel" aria-hidden="true"
    class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-y-auto overflow-x-hidden p-4 opacity-0 transition-all duration-300 ease-in-out scale-95">
    <div class="relative w-full max-w-lg rounded-lg bg-white shadow-xl dark:bg-gray-800">
        <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="editLaporanModalLabel">
                Judul Modal Edit
            </h3>
            <button type="button" id="closeModalHeaderBtn"
                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                aria-label="Close modal">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Tutup modal</span>
            </button>
        </div>

        <div class="p-4 md:p-5">
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                Konten untuk form edit akan ada di sini.
            </p>

        </div>

        <div class="flex items-center justify-end rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
            <button type="button" id="closeEditModalFooterBtn" {{-- Saya ganti ID agar lebih deskriptif --}}
                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                Tutup
            </button>
            {{-- <button type="button" class="ms-3 rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aksi Lain</button> --}}
        </div>
    </div>
</div>

<button id="buttonEditModal" class="show-modal rounded-full bg-blue-500 border px-3 py-3 m-5">
    Edit
</button>