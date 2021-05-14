<?php
namespace App\Models;

/**
 * Class AkaMatkul
 *
 * @property string $matkul_id
 * @property string $matkul_nama
 * @property string $matkul_inggris
 */
class AkaMatkul extends BaseModel {
	protected $table = 'aka_matkul';
	protected $primaryKey = 'matkul_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'matkul_nama',
		'matkul_inggris'
	];
}
