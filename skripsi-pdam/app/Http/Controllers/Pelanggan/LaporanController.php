<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanCreateRequest;
use App\Services\Laporan\User\LaporanPengguna;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    protected LaporanPengguna $laporanPenggunaService;

    public function __construct(LaporanPengguna $laporanPenggunaService)
    {
        $this->laporanPenggunaService = $laporanPenggunaService;
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();


        $laporans = $this->laporanPenggunaService->IndexLaporan($userId);


        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(LaporanCreateRequest $request)
    {
        DB::beginTransaction();
        $validatedData = $request->validated();


        try {

            if ($request->hasFile('foto_url')) {
                $uploadFile = Cloudinary::upload($request->file('foto_url')->getRealPath(), [
                    'folder' => 'laporan',
                ])->getSecurePath();
            }

            $laporanCreate = [
                'pelanggan_id' => Auth::id(),
                'judul' => $validatedData['judul'],
                'deskripsi' => $validatedData['deskripsi'],
                'lokasi' => $validatedData['lokasi'],
                'foto_url' => $uploadFile,
                'tingkat_urgensi' => $validatedData['tingkat_urgensi'],
                'status' => 'pending',
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
            ];

            $laporan = $this->laporanPenggunaService->CreateLaporan($laporanCreate);
            if ($laporan) {
                DB::commit();
                return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal membuat laporan: ' . $e->getMessage()]);
        }
    }

    public function edit($laporan_uuid)
    {
        $laporans = $this->laporanPenggunaService->GetLaporanByUuid($laporan_uuid);

        if (!$laporans) {
            return redirect()->route('laporan.index')->withErrors(['error' => 'Laporan tidak ditemukan.']);
        }
        return view('laporan.edit', compact('laporan'));
    }

    public function editStore($laporan_uuid, LaporanCreateRequest $request)
    {

        DB::beginTransaction();
        $validatedData = $request->validated();
        $uploadFile = null;

        try {
            if ($request->hasFile('foto_url')) {
                $uploadFile = Cloudinary::upload($request->file('foto_url')->getRealPath(), [
                    'folder' => 'laporan',
                ])->getSecurePath();
            }

            $laporanUpdate = [
                'judul' => $validatedData['judul'],
                'deskripsi' => $validatedData['deskripsi'],
                'lokasi' => $validatedData['lokasi'],
                'foto_url' => $uploadFile,
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
            ];

            $laporan = $this->laporanPenggunaService->UpdateLaporan($laporan_uuid, $laporanUpdate);
            if ($laporan) {
                DB::commit();
                return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui laporan: ' . $e->getMessage()]);
        }
    }
}
