<?php

namespace App\Http\Controllers\Teknisi;

use App\Services\Dokumentasi\Teknisi\DokumentasiTeknisi;
use App\Services\Penugasan\Teknisi\PenugasanTeknisi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PenugasanTeknisiController
{

    protected $penugasanTeknisi;

    public function __construct(DokumentasiTeknisi $penugasanTeknisi)
    {
        $this->penugasanTeknisi = $penugasanTeknisi;
    }

    public function getIndex()
    {

        $data = $this->penugasanTeknisi->GetPenugasanIndex();
        return view('teknisi.index-penugasan', compact('data'));
    }
}
