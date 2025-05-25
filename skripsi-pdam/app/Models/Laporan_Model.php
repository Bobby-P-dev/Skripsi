<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Model extends Model
{
    use HasUuids;
    use HasFactory;
    protected $fillable = [
        'pelanggan_id',
        'admin_id',
        'judul',
        'deskripsi',
        'lokasi',
        'tingkat_urgensi',
        'status',
        'foto_url',
        'longitude',
        'latitude',
    ];
    protected $table = 'laporan';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $primaryKey = 'laporan_uuid';

    public function admin()
    {
        return $this->belongsTo(Pengguna_Model::class, 'admin_id', 'pengguna_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pengguna_Model::class, 'pelanggan_id', 'pengguna_id');
    }

    public function scopeMenungggu($query)
    {
        return $query->where('status', 'pending');
    }
}
