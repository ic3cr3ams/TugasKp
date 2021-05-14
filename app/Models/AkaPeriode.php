<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Class AkaPeriode
 *
 * @property string $periode_kode
 * @property string $periode_nama
 * @property string $periode_akademik
 * @property \Carbon\Carbon $periode_start
 * @property \Carbon\Carbon $periode_end
 * @property bool $periode_status
 * @property \Carbon\Carbon $periode_perwalian_start
 * @property \Carbon\Carbon $periode_perwalian_end
 * @property \Carbon\Carbon $periode_kul_start
 * @property \Carbon\Carbon $periode_kul_end
 * @property \Carbon\Carbon $periode_bataltambah_start
 * @property \Carbon\Carbon $periode_bataltambah_end
 * @property \Carbon\Carbon $periode_drop_start
 * @property \Carbon\Carbon $periode_drop_end
 * @property int $periode_tipe
 * @property \Carbon\Carbon $periode_ban_bau
 */
class AkaPeriode extends BaseModel {
    protected $table = 'aka_periode';
    protected $primaryKey = 'periode_kode';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'periode_status' => 'bool',
        'periode_tipe' => 'int'
    ];

    protected $dates = [
        'periode_start',
        'periode_end',
        'periode_perwalian_start',
        'periode_perwalian_end',
        'periode_kul_start',
        'periode_kul_end',
        'periode_bataltambah_start',
        'periode_bataltambah_end',
        'periode_drop_start',
        'periode_drop_end',
        'periode_ban_bau'
    ];

    protected $fillable = [
        'periode_nama',
        'periode_akademik',
        'periode_start',
        'periode_end',
        'periode_status',
        'periode_perwalian_start',
        'periode_perwalian_end',
        'periode_kul_start',
        'periode_kul_end',
        'periode_bataltambah_start',
        'periode_bataltambah_end',
        'periode_drop_start',
        'periode_drop_end',
        'periode_ban_bau'
    ];

    protected $appends = ['periode_text'];

    /**
     * Untuk mendapatkan periode dalam versi text
     */
    public function getPeriodeTextAttribute()
    {
        return $this->periode_nama." ".$this->periode_akademik;
    }

    /**
     * Untuk mendapatkan periode yang sedang berjalan sekarang
     *
     * @return AkaPeriode
     */
    public static function PeriodeSkrg($periode_tipe = '9')
    {
        return AkaPeriode::where("periode_status", "1")
            ->where("periode_tipe", $periode_tipe)
            ->orderBy('periode_kode', 'DESC')
            ->first();
    }

    /**
     * Untuk mendapatkan periode yang sedang berjalan sekarang
     *
     * @return AkaPeriode
     */
    public static function PeriodeSebelumnya($periode_kode, $periode_tipe = '', $nosempendek = 1)
    {
        $ret = '';
        $whereTipe = '';
        if ($periode_tipe != '') {
            $whereTipe .= "periode_tipe = '$periode_tipe'";
        } else {
            $whereTipe .= "periode_tipe = 9";
        }
        if ($nosempendek == 1) {
            $ret = AkaPeriode::from("aka_periode as ak")
                ->where("ak.periode_kode", "<", $periode_kode)
                ->whereRaw("RIGHT(periode_kode,1) != 3")
                ->whereRaw($whereTipe)
                ->orderBy("periode_kode", "DESC")
                ->first();
        } else {
            $ret = AkaPeriode::from("aka_periode as ak")
                ->where("ak.periode_kode", "<", $periode_kode)
                ->whereRaw($whereTipe)
                ->orderBy("periode_kode", "DESC")
                ->first();
        }
        return $ret;
    }

    /**
     * Mendapatkan periode dosen dari awal mengajar sampai terakhir mengajar
     *
     * @param string $kodeDosen Kode dari dosen yang dimaksud
     * @return AkaPeriode
     */
    public static function PeriodeDosen($kodeDosen)
    {
        return AkaPeriode::whereIn("periode_kode", function ($query) use ($kodeDosen) {
            $query->select("aka_kelas.periode_kode")
                ->from("aka_kelas")
                ->where("aka_kelas.dosen_kode", $kodeDosen);
        })->orderBy("periode_kode", "ASC")
            ->get();
    }

    /**
     * Mengembalikan tahun kapan periode ini dimulai
     *
     * @return String
     */
    public function Tahun() {
        return substr($this->periode_kode, 0, 4);
    }
}
