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
            return $pengguna->fresh();
        }
        return null;
    }

    public function DeletePengguna(int $pengguna_id)
    {
        try {
            $pengguna = Pengguna_Model::where('pengguna_id', $pengguna_id)->firstOrFail();

            return $pengguna->delete();
        } catch (ModelNotFoundException $e) {
            // Handle the case where the pengguna is not found

            return false;
        }
    }

    public function GetCountPengguna()
    {
        return Pengguna_Model::count();
    }
}
