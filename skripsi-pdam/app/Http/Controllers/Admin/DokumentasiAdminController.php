<?php

namespace App\Http\Controllers\Admin;

use App\Services\Dokumentasi\Admin\DokumentasiAdmin;

class DokumentasiAdminController
{

    protected $dokumentasiAdminService;
    public function __construct(DokumentasiAdmin $dokumentasiAdminService)
    {
        $this->dokumentasiAdminService = $dokumentasiAdminService;
    }

    public function index()
    {
        $data = $this->dokumentasiAdminService->GetDokumentasiIndex();
        return view('admin.dokumentasi.dokumentasi-index', compact('data'));
    }
}
