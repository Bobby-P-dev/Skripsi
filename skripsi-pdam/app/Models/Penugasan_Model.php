<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan_Model extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_uuid',
        'teknisi_id',
        'admin_id',
        'tenggat_waktu',
        'catatan',
    ];

    protected $table = 'penugasan';
    protected $primaryKey = 'penugasan_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function laporan()
    {
        return $this->belongsTo(Laporan_Model::class, 'laporan_uuid', 'laporan_uuid');
    }

    public function teknisi()
    {
        return $this->belongsTo(Pengguna_Model::class, 'teknisi_id', 'pengguna_id');
    }

    public function admin()
    {
        return $this->belongsTo(Pengguna_Model::class, 'admin_id', 'pengguna_id');
    }
}
