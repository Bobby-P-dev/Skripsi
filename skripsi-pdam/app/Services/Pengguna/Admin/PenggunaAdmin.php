<?php

namespace App\Services\Pengguna\Admin;

interface PenggunaAdmin
{
    public function EditStore(array $data, int $pengguna_id);
    public function DeletePengguna(int $pengguna_id);
}
