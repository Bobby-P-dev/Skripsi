<?php

use App\Http\Controllers\Controller;
use App\Http\Requests\PenugasanCreateRequest;
use App\Http\Requests\PenuggasanCreateRequest;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use Illuminate\Support\Facades\DB;

class PenugasanAdminController extends Controller
{
    public function CreateIndex($laporan_uuid)
    {
        $laporan = Laporan_Model::where('uuid', $laporan_uuid)
            ->where('status', 'pending')
            ->firstOrFail();
        $teknisi = Pengguna_Model::where('role', 'teknisi')->get();

        return view('layouts.home', compact('laporan', 'teknisi'));
    }

    public function StorePenuggasan(PenuggasanCreateRequest $request)
    {

        DB::beginTransaction();
        try {

            $laporan = Laporan_Model::where('uuid', $request->lapaoran_uuid)->first();
            $laporan->status = 'dalam penanganan';
            $laporan->save();

            Penugasan_Model::created([
                'laporan_uuid' => $request->laporan_uuid,
                'teknisi_id' => $request->teknisi_id,
                'admin_id' => $request->admin_id,
                'tenggat_waktu' => $request->tenggat_waktu,
                'catatan' => $request->catatan,
            ]);

            DB::commit();
            return redirect()->route('penugasan')->with('succsess', 'penugasan created succesfuly');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create penugasan: ' . $e->getMessage()]);
        };
    }
}
