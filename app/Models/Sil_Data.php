<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sil_Data extends BaseModel
{
	protected $table = 'sil_data';
	protected $primaryKey = 'kode_matkul';
	public $incrementing = false;
	public $timestamps = false;
}
