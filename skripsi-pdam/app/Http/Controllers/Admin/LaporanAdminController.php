<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Model;
use App\View\Components\laporan;
use DB;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAdminController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to view this page.']);
        }
        $laporanSaya = Laporan_Model::joinWithPengguna()->orderBy('laporan.created_at', 'desc')->get();

        // opsi untuk paginasi mas
        // $laporanSaya = Laporan_Model::joinWithPengguna()->orderBy('laporan.created_at', 'desc')->paginate(10);

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
            $laporan->update([
                'admin_id' => Auth::id(),
                'status'   => 'diterima',
            ]);
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
            $laporan->update([
                'admin_id' => Auth::id(),
                'status' => 'ditolak',
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Laporan berhasil ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menolak laporan: ' . $e->getMessage()]);
        }
    }
}
