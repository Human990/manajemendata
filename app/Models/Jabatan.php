<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $primaryKey = 'kode_jabatanlama';

    public function pegbul()
    {
        return $this->hasMany(Pegbul::class, 'kode_jabatanlama', 'kode_jabatanlama');
    }

    // public function pegawai()
    // {
    //     return $this->hasMany(Pegawai::class, 'kode_jabatanlama', 'kode_jabatanlama');
    // }
}
