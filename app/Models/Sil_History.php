<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sil_History extends BaseModel
{
	protected $table = 'sil_history';
	protected $primaryKey = 'id_silhistory';
	public $incrementing = true;
	public $timestamps = true;

    protected $fillable = ['dosen_nama_sk','isi'];
}
