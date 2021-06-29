<?php

namespace App\Exports;

use App\Models\Sil_History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class history implements FromCollection,WithHeadings
{
    // use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Sil_History::all();
    }

    public function headings():array
    {
        return ["ID", "Nama Dosen", "Isi","Update at","Created at"];
    }
}
