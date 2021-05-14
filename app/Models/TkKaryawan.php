<?php
namespace App\Models;

/**
 * Class TkKaryawan
 *
 * @property string $karyawan_nip
 * @property string $agama_kode
 * @property string $golongan_kode
 * @property string $kota_kode
 * @property string $karyawan_ktp
 * @property \Carbon\Carbon $karyawan_ktp_expired
 * @property string $karyawan_nama
 * @property string $karyawan_gelar
 * @property string $karyawan_sex
 * @property string $karyawan_alamat
 * @property string $karyawan_kodepos
 * @property string $karyawan_telp
 * @property string $karyawan_hp
 * @property string $karyawan_email
 * @property string $karyawan_sk_no
 * @property string $karyawan_intranet
 * @property \Carbon\Carbon $karyawan_lahir_tanggal
 * @property string $karyawan_lahir_kota
 * @property int $karyawan_isdosen
 * @property \Carbon\Carbon $karyawan_start
 * @property \Carbon\Carbon $karyawan_stop
 * @property int $karyawan_status
 * @property string $absensi_kode
 */
class TkKaryawan extends BaseModel {

	protected $table = 'tk_karyawan';
	protected $primaryKey = 'karyawan_nip';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'karyawan_isdosen' => 'int',
        'karyawan_status' => 'int'
	];

	protected $dates = [
		'karyawan_ktp_expired',
		'karyawan_lahir_tanggal',
		'karyawan_start',
		'karyawan_stop'
	];

	protected $fillable = [
		'agama_kode',
		'golongan_kode',
		'kota_kode',
		'karyawan_ktp',
		'karyawan_ktp_expired',
		'karyawan_nama',
		'karyawan_gelar',
		'karyawan_sex',
		'karyawan_alamat',
		'karyawan_kodepos',
		'karyawan_telp',
		'karyawan_hp',
		'karyawan_email',
		'karyawan_sk_no',
		'karyawan_intranet',
		'karyawan_lahir_tanggal',
		'karyawan_lahir_kota',
		'karyawan_isdosen',
		'karyawan_start',
		'karyawan_stop',
		'karyawan_status',
		'absensi_kode'
    ];

    /**
     * Mendapatkan jenis kelamin karyawan dalam bentuk "teks"
     *
     * @return string
     */
    public function karyawan_sex() {
		return $this->attributes["karyawan_sex"] == "0" ? "Perempuan": "Laki-laki";
    }

    /**
     * Mendapatkan nomor telepon karyawan,
     * dengan tambahan jika kosong maka return "-"
     *
     * @return string
     */
    public function karyawan_telp() {
        return $this->default('karyawan_telp');
    }

    /**
     * Mendapatkan nomor HP karyawan,
     * dengan tambahan jika kosong maka return "-"
     *
     * @return string
     */
	public function karyawan_hp() {
        return $this->default('karyawan_hp');
	}

    /**
     * Mendapatkan status karyawan dalam bentuk "teks"
     *
     * @return string
     */
    public function status() {
        if (array_key_exists("dosen_status", $this->attributes))
            $status = $this->attributes["dosen_status"];
        else $status = $this->attributes["karyawan_status"];
        return $status == "1" ? "Aktif" : "Nonaktif";
    }

    public function TkPenjabatanStts() {
		return $this->belongsTo('App\Models\TkPenjabatanStts', 'karyawan_nip', 'karyawan_nip');
    }

    /**
     * Mengembalikan data jabatan, namun memproritaskan jabatan dosen jika ada,
     * jika jabatan dosen tidak ada, maka kembalikan apa adanya.
     *
     * @return App\Models\TkJabatanStts||App\Models\TkPenjabatanStts
     */
    public function GetJabatanDosen() {
        $data = TkJabatanStts::join('tk_penjabatan_stts', 'tk_penjabatan_stts.jabatan_s_kode', 'tk_jabatan_stts.jabatan_s_kode')
            ->where('karyawan_nip', $this->karyawan_nip)
            ->get();
        foreach ($data as $jabatan) {
            if ($jabatan->jabatan_s_jenis === 'dosen' || $jabatan->jabatan_s_jenis === 'kajur') {
                return $jabatan;
            }
        }
        return $data->first();
    }
}
