<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Services\Laporan\Admin\LaporanAdmin;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanAdminController extends Controller
{

    protected LaporanAdmin $laporanAdminService;
    public function __construct(LaporanAdmin $laporanAdminService)
    {
        $this->laporanAdminService = $laporanAdminService;
        $this->middleware('auth');
    }

    public function export(Request $request)
    {
        $tanggalMulai = $request->query('tanggal_mulai');
        $tanggalSelesai = $request->query('tanggal_selesai');

        $namaFile = 'laporan_' . now()->format('d-m-Y_H-i-s') . '.xlsx';

        return Excel::download(new LaporanExport($tanggalMulai, $tanggalSelesai), $namaFile);
    }

    public function indexKlusterLaporanPending()
    {
        // --- 1. Panggil Service untuk mendapatkan laporan yang sudah dikelompokkan ---
        $epsilon = 0.01;
        $minSamples = 3;
        $hasilCluster = $this->laporanAdminService->clusterLaporanPending($epsilon, $minSamples);

        // --- 2. Ambil daftar teknisi secara terpisah di Controller ---
        $teknisi = Pengguna_Model::where('peran', 'teknisi')
            ->select('pengguna_id', 'nama')
            ->orderBy('nama', 'asc') // Urutkan berdasarkan nama lebih umum untuk daftar
            ->get(); // Gunakan get() untuk mengambil semua teknisi

        // --- 3. Kirim SEMUA data yang dibutuhkan ke Blade view ---
        return view('admin.laporan.laporan-index', [
            'clusters' => $hasilCluster['clusters'],
            'noise' => $hasilCluster['noise'],
            'teknisi' => $teknisi, //
        ]);
    }

    public function index()
    {

        $laporan = $this->laporanAdminService->laporanNotPending();
        // --- 2. Ambil daftar teknisi secara terpisah di Controller ---
        $teknisi = Pengguna_Model::where('peran', 'teknisi')
            ->select('pengguna_id', 'nama')
            ->orderBy('nama', 'asc') // Urutkan berdasarkan nama lebih umum untuk daftar
            ->get(); // Gunakan get() untuk mengambil semua teknisi

        // --- 3. Kirim SEMUA data yang dibutuhkan ke Blade view ---
        return view('admin.laporan.datalaporan-index', [
            'laporanSaya' => $laporan,
            'teknisi' => $teknisi, //
        ]);
    }

    public function showLaporan()
    {
        return view('laporan.acc');
    }
    public function accLaporan(Laporan_Model $laporan)
    {
        DB::beginTransaction();
        try {
            $this->laporanAdminService->accLaporan($laporan);
            DB::commit();
            return redirect()->back()->with('success', 'Laporan berhasil diterima.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menerima laporan: ' . $e->getMessage()]);
        }
    }

    public function tolakLaporan(Laporan_Model $laporan)
    {
        DB::beginTransaction();
        try {
            $this->laporanAdminService->tolakLaporan($laporan);
            DB::commit();
            return redirect()->back()->with('success', 'Laporan berhasil ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menolak laporan: ' . $e->getMessage()]);
        }
    }
}
