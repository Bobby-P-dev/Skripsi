<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenuggasanCreateRequest;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use Illuminate\Support\Facades\Auth;
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


    public function store(PenuggasanCreateRequest $request) // Nama method dan Form Request disesuaikan
    {
        DB::beginTransaction();
        try {

            $laporan = Laporan_Model::where('laporan_uuid', $request->input('laporan_uuid'))->first();


            if (!$laporan) {
                DB::rollBack();
                return redirect()->back()->withInput()->withErrors(['laporan_uuid' => 'Laporan yang dipilih tidak valid atau tidak ditemukan.']);
            }

            $laporan->status = 'ditugaskan';
            $laporan->save();

            Penugasan_Model::create([
                'laporan_uuid'  => $laporan->laporan_uuid,
                'teknisi_id'    => $request->input('teknisi_id'),
                'admin_id'      => Auth::id(),
                'tenggat_waktu' => $request->input('tenggat_waktu'),
                'catatan'       => $request->input('catatan'),
            ]);

            DB::commit();

            return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal membuat penugasan: ' . $e->getMessage()]);
        }
    }
}
