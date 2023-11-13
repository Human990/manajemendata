<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;

class Lock extends Model
{
    use HasFactory;

    public static function data()
    {
        $data = Opd::where('kode_sub_opd', Auth::user()->kode_sub_opd)->where('tahun_id', session()->get('tahun_id_session'))->value('lock');

        return $data;
    }

    public static function status($id)
    {
        $data = Opd::where('id', $id)->where('tahun_id', session()->get('tahun_id_session'))->value('lock');

        return $data;
    }
}
