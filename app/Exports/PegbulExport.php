<?php

namespace App\Exports;

use App\Models\Pegbul;
use Maatwebsite\Excel\Concerns\FromCollection;

class PegbulExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegbul::all();
    }
}
