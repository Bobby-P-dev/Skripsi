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
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function laporan(){
        return $this->hasOne(Laporan_Model::class, 'laporan_uuid');
    }

    public function teknisi(){
        return $this->belongsTo(Pengguna_Model::class, 'pengguna_id', 'teknisi_id');
    }

    public function admin(){
        return $this->belongsTo(Pengguna_Model::class, 'pengguna_id', 'admin_id');
    }
}
