<?php
namespace App\Models;

use App\Library\Helper;
use Illuminate\Support\Facades\DB;

/**
 * Class AkaKelas
 *
 * @property string $kelas_id
 * @property string $periode_kode
 * @property string $mk_kode
 * @property string $major_id
 * @property string $ruangan_kode
 * @property string $dosen_kode
 * @property string $kelas_kelompok
 * @property string $kelas_starttime
 * @property string $kelas_endtime
 * @property string $kelas_hari
 * @property int $kelas_jum_peserta
 * @property int $kelas_kode_gabungan
 */
class AkaKelas extends BaseModel {
	protected $table = "aka_kelas";
	protected $primaryKey = 'kelas_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'kelas_jum_peserta' => 'int',
		'kelas_kode_gabungan' => 'int'
	];

	protected $fillable = [
		'periode_kode',
		'mk_kode',
		'major_id',
		'ruangan_kode',
		'dosen_kode',
		'kelas_kelompok',
		'kelas_starttime',
		'kelas_endtime',
		'kelas_hari',
		'kelas_jum_peserta',
		'kelas_kode_gabungan'
	];

	public function TkDosen() {
		return $this->hasOne('App\Models\TkDosen', 'dosen_kode', 'dosen_kode');
	}

	public function getHari() {
		return Helper::convertDay($this->kelas_hari);
	}

	public function AkaPeriode() {
		return $this->hasOne('App\Models\AkaPeriode', 'periode_kode', 'periode_kode');
	}

	public function AkaMatkulKurikulum() {
		return $this->hasOne('App\Models\AkaMatkulKurikulum', 'mk_kode', 'mk_kode');
	}

	public function AkaMajor() {
		return $this->belongsTo('App\Models\AkaMajor', 'major_id', 'major_id');
	}

    public function AkaJurusan()
    {
		return $this->belongsTo('App\Models\AkaJurusan', 'jur_kode', 'jur_kode');
    }

    /**
     * Mendapatkan jam kelas berakhir.
     *
     * @return String
     */
	public function getEndTime() {
        //jika kelas_endtime sudah ditentukan, atau mk_sks nya -1
        //-1 berasal dari kueri gabungan dengan jadwal praktikum di Mhs@JadwalKul
        if ($this->kelas_endtime !== '00.00' || $this->mk_sks == -1)
            return $this->kelas_endtime;

		$endTimeHour = substr($this->kelas_starttime,0,2);
		$endTimeMin = substr($this->kelas_starttime,3);
		if ($this->mk_sks > 0) {
			$endTimeMin += 50 * $this->mk_sks;
			$endTimeHour += floor($endTimeMin / 60);
			$endTimeMin %= 60;
			if ($endTimeHour < 10) $endTimeHour = "0$endTimeHour";
			if ($endTimeMin < 10) $endTimeMin = "0$endTimeMin";
            $this->kelas_endtime = "$endTimeHour.$endTimeMin";
		} else if (substr($this->matkul_nama, 0, 3) == 'ECC'){
			$endTimeMin += 90;
			$endTimeHour += floor($endTimeMin / 60);
			$endTimeMin %= 60;
			if ($endTimeHour < 10) $endTimeHour = "0$endTimeHour";
			if ($endTimeMin < 10) $endTimeMin = "0$endTimeMin";
			$this->kelas_endtime = "$endTimeHour.$endTimeMin";
		} else $this->kelas_endtime = '?';
		return $this->kelas_endtime;
	}

	public function getKelas() {
		if ($this->kelas_kelompok === 'X') return '-';
		else return $this->kelas_kelompok;
    }

    /**
     * Mendapatkan nama dosen yang mengajar kelas ini
     * Mengembalikan '-' jika belum ada yang mengajar
     * (digunakan setelah LEFT JOIN dengan tk_dosen)
     *
     * @return string
     */
    public function getNamaDosen() {
        if ($this->dosen_nama_sk === null || $this->dosen_kode === 'XXXX') return '-';
        else return $this->dosen_nama_sk;
    }

    /**
     * Mendapatkan nama dosen yang mengajar kelas ini
     * Mengembalikan '-' jika belum ada yang mengajar
     * (digunakan setelah LEFT JOIN dengan tk_dosen)
     *
     * @return string
     */
    public function getKodeDosen() {
        if ($this->dosen_kode === null || $this->dosen_kode === 'XXXX') return '';
        else return $this->dosen_kode;
    }
}
