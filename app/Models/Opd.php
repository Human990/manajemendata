<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opd extends Model
{
    use HasFactory;

    protected $guarded=[];

    // public function pegawai()
    // {
    //     return $this->hasMany(Pegawai::class, 'opd_id', 'id');
    // }

}
