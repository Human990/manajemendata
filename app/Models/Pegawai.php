<?php

namespace App\Models;

use App\Models\Opd;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'kode_jabatanlama', 'kode_jabatanlama');
    }

    public function opds()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
}
