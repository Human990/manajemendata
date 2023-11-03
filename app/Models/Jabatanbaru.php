<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatanbaru extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="jabatanbaru";
    protected $fillable = [
        'kode_jabatanbaru',
        'nama_jabatan',
        'jenis_jabatan',
        'kelas_jabatan',
        'nilai_jabatan',
        'index',
        'tunjab',
        'tahun',
    ];

    public function pegbul() {
        return $this->hasMany(Pegbul::class);
    }
}
