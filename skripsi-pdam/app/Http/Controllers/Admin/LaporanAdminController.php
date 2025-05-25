<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Model;
use DB;
use Illuminate\Http\Client\Request;

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
    public function accLaporan(Request $request, $id)
    {
        //kekurangan menambahkan validasi untuk memastikan admin yang dapat mengakses
        DB::beginTransaction();

        try {
            $laporan = Laporan_Model::findOrFail($id);
            $laporan->update(([
                'admin_id' => auth()->user()->id,
                'status' => $request['status'],
            ]));
            DB::commit();

            return redirect()->back()->with('success', 'Laporan accepted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to accept laporan: ' . $e->getMessage()]);
        }
    }
}
