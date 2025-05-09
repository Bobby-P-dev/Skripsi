<?php

namespace App\Http\Controllers;

use App\Models\Laporan_Model;
use DB;
use Illuminate\Http\Client\Request;
class LaporanAdminController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in to view this page.']);
        }
        $laporanMenunggu = Laporan_Model::where('status', 'pending')->get();
        $laporanSaya = Laporan_Model::where('admin_id', auth()->user()->id)->get();
        return view('laporan.index', compact('laporanMenunggu', 'laporanSaya'));
    }

    public function accLaporan(Request $request, $id)
    {
        //kekurangan menambahkan validasi untuk memastikan admin yang dapat mengakses
        $laporan = Laporan_Model::findOrFail($id);
        DB::beginTransaction();

        try{
        $laporan->update(([
            'admin_id' => auth()->user()->id,
            'status' => $request['status'],
        ]));
        DB::commit();

        return redirect()->back()->with('success', 'Laporan accepted successfully.');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to accept laporan: ' . $e->getMessage()]);
        }
    }
}
