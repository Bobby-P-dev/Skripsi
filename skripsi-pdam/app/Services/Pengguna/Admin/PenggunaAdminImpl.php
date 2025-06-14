<?php

namespace App\Services\Pengguna\Admin;

use App\Models\Pengguna_Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenggunaAdminImpl implements PenggunaAdmin
{
    public function EditStore(array $data, int $penggguna_id)
    {
        $pengguna = Pengguna_Model::where('pengguna_id', $penggguna_id)->first();
        if ($pengguna) {
            $pengguna->update($data);
        }
        return $pengguna->fresh();
    }

    public function DeletePengguna(int $pengguna_id)
    {
        try {
            $pengguna = Pengguna_Model::where('pengguna_id', $pengguna_id)->firstOrFail();

            return $pengguna->delete();
        } catch (ModelNotFoundException $e) {

            return false;
        }
    }
}
