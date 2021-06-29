<?php

namespace App\Exports;

use App\Models\Sil_Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class datajurusan implements FromCollection,WithHeadings
{
    protected $jur_kode;

    public function __construct($jur_kode)
    {
        $this->jur_kode = $jur_kode;
    }

    public function collection()
    {
        return Sil_Data::join('sil_pengisi',function ($e)
                        {
                            $e->on('sil_pengisi.mk_kodebaa','sil_data.mk_kodebaa')
                            ->on('sil_pengisi.kurikulum_kode','sil_data.kurikulum_kode');
                        })
                        ->join('aka_matkul_kurikulum','aka_matkul_kurikulum.mk_kodebaa','sil_data.mk_kodebaa')
                        ->join('aka_kelas',function($q){
                            $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                            ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                        })
                        ->join('aka_jurusan','aka_jurusan.jur_kode','aka_kelas.jur_kode')
                        ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                        ->where( 'aka_jurusan.jur_kode', $this->jur_kode)
                        ->get
                        (["jur_nama","sil_pengisi.kurikulum_kode","dosen_nama_sk","pengisi_penugas","bahasa","materi","tujuan","tm_1","tm_2","tm_3","tm_4","tm_5","tm_6","tm_7","tm_8","tm_9","tm_10","tm_11","tm_12","tm_13","tm_14","rb_1","rb_2","rb_3","rb_4","rb_5"]);
    }
    public function headings():array
    {
        return [
            "Nama Jurusan",
            "Kurikulum",
            "Dosen Pengisi",
            "Dosen Penugas",
            "Bahasa",
            "Materi",
            "Tujuan",
            "Tatap Muka 1",
            "Tatap Muka 2",
            "Tatap Muka 3",
            "Tatap Muka 4",
            "Tatap Muka 5",
            "Tatap Muka 6",
            "Tatap Muka 7",
            "Tatap Muka 8",
            "Tatap Muka 9",
            "Tatap Muka 10",
            "Tatap Muka 11",
            "Tatap Muka 12",
            "Tatap Muka 13",
            "Tatap Muka 14",
            "Referensi Buku 1",
            "Referensi Buku 2",
            "Referensi Buku 3",
            "Referensi Buku 4",
            "Referensi Buku 5",
        ];
    }
}
