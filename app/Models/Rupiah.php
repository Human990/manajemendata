<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rupiah extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="master_rupiah";
    protected $fillable=[
        'nama',
        'jumlah',
        'tahun_id',
        'asal_id',
    ];
}
