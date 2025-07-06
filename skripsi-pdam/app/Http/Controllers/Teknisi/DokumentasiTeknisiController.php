<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Requests\DokumentasiCreateRequest;
use App\Services\Dokumentasi\Teknisi\DokumentasiTeknisi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class DokumentasiTeknisiController
{

    protected $dokumentasiService;

    public function __construct(DokumentasiTeknisi $dokumentasiService)
    {
        $this->dokumentasiService = $dokumentasiService;
    }

    public function index()
    {
        $data = $this->dokumentasiService->GetDokumentasiIndex(auth()->id());
        return view('teknisi.index-dokumentasi', compact('data'));
    }
    public function store(DokumentasiCreateRequest $request)
    {
        try {
            $validateData = $request->validated();

            if ($request->hasFile('foto_url')) {
                $uploadFile = Cloudinary::upload($request->file('foto_url')->getRealPath(), [
                    'folder' => 'laporan',
                ])->getSecurePath();
            }

            $validateData['foto_url'] = $uploadFile;

            $this->dokumentasiService->CreateDokumentasi($validateData);

            return redirect()->back()->with('succes', 'berhasil membuat data');
        } catch (\Exception $e) {
            Log::error('gagal menyimpan data' . $e->getMessage());
            return redirect()->back()->withErrors("gagal menyimpan data");
        }
    }
}
