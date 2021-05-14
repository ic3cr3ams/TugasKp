<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class AkaMatkulKurikulum
 * 
 * @property string $mk_kode
 * @property string $major_id
 * @property string $matkul_id
 * @property string $kurikulum_kode
 * @property int $mk_semester
 * @property string $mk_kodebaa
 * @property int $mk_sks
 * @property string $mk_deskripsi
 * @property bool $mk_berpraktikum
 * @property string $mk_grade_min
 * @property int $mk_min_sks
 * @property string $jur_kode
 * @property string $mk_is_hitung
 * @property string $mk_status
 */
class AkaMatkulKurikulum extends BaseModel {
	protected $table = 'aka_matkul_kurikulum';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'mk_semester' => 'int',
		'mk_sks' => 'int',
		'mk_berpraktikum' => 'bool',
		'mk_min_sks' => 'int'
	];

	protected $fillable = [
		'matkul_id',
		'kurikulum_kode',
		'mk_semester',
		'mk_kodebaa',
		'mk_sks',
		'mk_deskripsi',
		'mk_berpraktikum',
		'mk_grade_min',
		'mk_min_sks',
		'jur_kode',
		'mk_is_hitung',
		'mk_status'
	];
	
	public function AkaMajor() {
		return $this->hasOne('App\Models\AkaMajor', 'major_id', 'major_id');
	}
	
	public function AkaMatkul() {
		return $this->hasOne('App\Models\AkaMatkul', 'matkul_id', 'matkul_id');
	}
	
	public function Kurikulum() {
		return $this->belongsTo('App\Models\AkaKurikulum', 'kurikulum_kode', 'kurikulum_kode');
	}

	public function AkaJurusan(){
		return $this->hasOne('App\Models\AkaJurusan', 'jur_kode', 'jur_kode');
	}

    public static function checkBerpraktikum($mk_kode = '')
    {
        $ret = [];
        if($mk_kode != '')
        {
            if(is_array($mk_kode))
            {
                $where = '1=1 AND(';
                for($i = 0; $i < count($mk_kode); $i++)
                {
                    $where .= "amk.mk_kode = '$mk_kode[$i]'";
                    if($i < (count($mk_kode)-1))
                    {
                        $where .= ' OR ';
                    }
                }
                $where .= ')';
                $result = AkaMatkulKurikulum::from("aka_matkul_kurikulum as amk")
                                            ->select(DB::raw("CASE amk.mk_berpraktikum WHEN 1 THEN amk.mk_kode END AS mk_kode"))
                                            ->whereRaw($where)
                                            ->havingRaw('!(ISNULL(mk_kode))')
                                            ->get();

                foreach($result as $r)
                {
                    $ret[] = $r['mk_kode'];
                }
                return $ret;
            }elseif(is_string($mk_kode))
            {
                $result = AkaMatkulKurikulum::from("aka_matkul_kurikulum as amk")
                                            ->select(DB::raw('CASE amk.mk_berpraktikum WHEN 1 THEN amk.mk_kode END AS mk_kode'))
                                            ->where("amk.mk_kode",$mk_kode)
                                            ->havingRaw('!(ISNULL(mk_kode))')
                                            ->first();

                if($result['mk_kode'])
                {
                    $ret[] = $result['mk_kode'];
                }else{
                    $ret = [];
                }
                return $ret;
            }
        }
    }
}
