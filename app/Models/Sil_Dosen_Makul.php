<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sil_Dosen_Makul extends BaseModel
{
	protected $table = 'sil_dosen_makul';
	protected $primaryKey = 'kode_dosen_makul ';
	public $incrementing = false;
	public $timestamps = false;
}
