<?php

namespace App\Http\Controllers\Teknisi;

use App\Services\Penugasan\Teknisi\PenugasanTeknisi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PenugasanTeknisiController
{

    protected $penugasanTeknisi;

    public function __construct(PenugasanTeknisi $penugasanTeknisi)
    {
        $this->penugasanTeknisi = $penugasanTeknisi;
    }

    public function getIndex()
    {
        $teknisi_id = Auth::id();
        try {
            $data = $this->penugasanTeknisi->GetIndex($teknisi_id);
            return view('teknisi.index-dokumentasi', compact('data'));
        } catch (ModelNotFoundException $e) {
            abort(404, "data tidak di temukan");
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data' . $e->getMessage());
            return redirect()->back()->withErrors("internal server error");
        }
    }
}
