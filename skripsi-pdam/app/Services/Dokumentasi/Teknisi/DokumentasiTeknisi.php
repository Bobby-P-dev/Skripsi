<?php

namespace App\Services\Dokumentasi\Teknisi;

interface DokumentasiTeknisi
{
    public function GetIndex(int $teknisi_id);
    public function CreateDokumentasi(array $data);
    public function EditDokumentasi(array $data, int $dokumentasi_id);
}
