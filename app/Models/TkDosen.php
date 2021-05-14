<?php
namespace App\Models;

use App\Models\TkKaryawan;
use Illuminate\Support\Facades\DB;

/**
 * Class TkDosen
 *
 * @property string $dosen_kode
 * @property string $dosen_nama_sk
 * @property string $golongan_kode
 * @property string $karyawan_nip
 * @property string $dosen_jurusan_esbed
 * @property string $dosen_jurusan_stts
 * @property string $dosen_nidn
 * @property \Carbon\Carbon $dosen_start
 * @property \Carbon\Carbon $dosen_stop
 * @property int $dosen_status
 * @property string $dosen_sertifikasi
 *
 * @property TkKaryawan $TkKaryawan
 */
class TkDosen extends BaseModel {
	protected $table = 'tk_dosen';
	protected $primaryKey = 'dosen_kode';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dosen_status' => 'int'
	];

	protected $dates = [
		'dosen_start',
		'dosen_stop'
	];

	protected $fillable = [
		'dosen_nama_sk',
		'golongan_kode',
		'karyawan_nip',
		'dosen_jurusan_esbed',
		'dosen_jurusan_stts',
		'dosen_nidn',
		'dosen_start',
		'dosen_stop',
		'dosen_status',
		'dosen_sertifikasi'
	];

	public function nama() {
		return $this->attributes["dosen_nama_sk"] == "" ? "-": $this->attributes["dosen_nama_sk"];
	}

	public function Kelas() {
		return $this->hasMany('App\Models\AkaKelas','dosen_kode','dosen_kode');
    }
}
