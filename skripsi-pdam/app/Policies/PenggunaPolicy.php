<?php

namespace App\Policies;

use App\Models\Pengguna_Model;
use Illuminate\Auth\Access\Response;

class PenggunaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Pengguna_Model $penggunaModel): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view( Pengguna_Model $penggunaModel): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(Pengguna_Model $user)
    {
        return $user->peran === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update( Pengguna_Model $penggunaModel): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete( Pengguna_Model $penggunaModel): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore( Pengguna_Model $penggunaModel): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete( Pengguna_Model $penggunaModel): bool
    {
        //
    }
}
