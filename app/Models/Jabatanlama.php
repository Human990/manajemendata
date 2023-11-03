<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatanlama extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="jabatanlama";
    protected $fillable = [
        'kode_jabatanlama',
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
