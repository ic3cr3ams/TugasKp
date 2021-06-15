<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sil_History extends BaseModel
{
	protected $table = 'sil_data';
	protected $primaryKey = 'dosen_kode';
	public $incrementing = false;
	public $timestamps = false;
}
