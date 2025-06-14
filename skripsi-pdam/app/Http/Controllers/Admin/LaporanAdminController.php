<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Laporan_Model;
use App\Services\Laporan\Admin\LaporanAdmin;
use App\View\Components\laporan;
use DB;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
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

    public function index()
    {
        $laporanSaya = $this->laporanAdminService->index();

        return view('admin.laporan-index', compact('laporanSaya'));
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
