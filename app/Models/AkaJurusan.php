<?php
namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

/**
 * Class AkaJurusan
 *
 * @property string $jur_kode
 * @property string $jur_nama
 * @property string $jur_singkat
 * @property string $jur_gelar
 * @property string $jur_gelar_singkat
 * @property int $jur_status
 * @property string $jur_matauang
 * @property string $jur_fakultas
 */
class AkaJurusan extends BaseModel {
	protected $table = 'aka_jurusan';
	protected $primaryKey = 'jur_kode';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'jur_status' => 'int'
	];

	protected $fillable = [
		'jur_nama',
		'jur_singkat',
		'jur_gelar',
		'jur_gelar_singkat',
		'jur_status',
		'jur_matauang',
        'jur_fakultas'
    ];

    /**
     * Mendapatkan daftar kode angkatan yang aktif dari jurusan yang dipilih
     * contoh hasil : 203, 204, 205, 206 (mengembalikan 3 digit pertama NRP, bukan tahun)
     *
     * @return Collection
     */
    public function GetAngkatanAktif() {
        return Mahasiswa::select(DB::raw('SUBSTR(mhs_nrp, 1, 3) as kode'))
            ->where('mhs_status', '1')
            ->where('jur_kode', $this->jur_kode)
            ->groupBy(DB::raw('SUBSTR(mhs_nrp, 1, 3)'))
            ->get()
            ->pluck('kode');
    }
}
