<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi_Model extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_uuid',
        'teknisi_id',
        'foto_url',
        'keterangan',
        'tindakan',
    ];
    // -relasi penugasan
    protected $table = 'dokumentasi';
    protected $primaryKey = 'dokumentasi_id';
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';


    public function laporan()
    {
        return $this->hasOne(Laporan_Model::class, 'laporan_uuid', 'laporan_uuid');
    }

    public function teknisi()
    {
        return $this->belongsTo(Pengguna_Model::class, 'teknisi_id', 'pengguna_id');
    }
}
