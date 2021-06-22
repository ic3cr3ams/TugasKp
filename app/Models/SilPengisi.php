<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilPengisi extends Model
{

    protected $table = 'sil_pengisi';
	protected $primaryKey = 'pengisi_id';
	public $incrementing = true;
	public $timestamps = false;

    protected $fillable = ['mk_kodebaa','periode_kode','dosen_kode','kurikulum_kode','pengisi_penugas'];
}
