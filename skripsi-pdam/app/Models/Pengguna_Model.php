<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Pengguna_Model extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telepon',
        'alamat',
        'peran',
        'foto_profil',
    ];

    protected $table = 'pengguna';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'pengguna_id';


    public function laporan()
    {
        return $this->hasMany(Laporan_Model::class, 'pengguna_id', 'pengguna_id');
    }
    public function penugasan()
    {
        return $this->hasMany(Penugasan_Model::class, 'pengguna_id', 'pengguna_id');
    }
    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi_Model::class, 'pengguna_id', 'pengguna_id');
    }
}
