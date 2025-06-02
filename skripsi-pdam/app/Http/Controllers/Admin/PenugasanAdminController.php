<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenuggasanCreateRequest;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use App\Services\Penugasan\Admin\PenugasanAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenugasanAdminController extends Controller
{
    protected PenugasanAdmin $penugasanAdminService;
    public function __construct(PenugasanAdmin $penugasanAdminService)
    {
        $this->penugasanAdminService = $penugasanAdminService;
        $this->middleware('auth');
    }
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

            $validatedData = $request->validated();

            $this->penugasanAdminService->store($validatedData);

            DB::commit();

            return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal membuat penugasan: ' . $e->getMessage()]);
        }
    }
}
