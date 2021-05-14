<?php
namespace App\Models;

/**
 * Class AkaMajor
 *
 * @property string $major_id
 * @property string $jur_kode
 * @property string $major_nama
 * @property string $major_singkat
 * @property int $major_status
 */
class AkaMajor extends BaseModel {
	protected $table = 'aka_major';
	protected $primaryKey = 'major_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'major_status' => 'int'
	];

	protected $fillable = [
		'jur_kode',
		'major_nama',
		'major_singkat',
		'major_status'
	];

	public function Jurusan() {
		return $this->belongsTo('App\Models\AkaJurusan', 'jur_kode', 'jur_kode');
	}
}
