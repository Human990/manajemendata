<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indeks extends Model
{
    use HasFactory;

    protected $guarded=[];

    public $table="indeks";

    protected $primaryKey = 'kode_indeks';
    
    protected $fillable = [
        'kode_indeks',
        'jenis_jabatan',
        'kelas_jabatan',
        'indeks',
        'tahun_id'
    ];
}
