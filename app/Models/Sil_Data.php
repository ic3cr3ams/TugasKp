<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sil_Data extends BaseModel
{
	protected $table = 'sil_data';
	protected $primaryKey = 'data_id';
	public $incrementing = true;
	public $timestamps = false;

    protected $fillable = [
        'mk_kodebaa',
        'bahasa',
        'kurikulum_kode',
        'materi',
        'tujuan',
        'tm_1',
        'tm_2',
        'tm_3',
        'tm_4',
        'tm_5',
        'tm_6',
        'tm_7',
        'tm_8',
        'tm_9',
        'tm_10',
        'tm_11',
        'tm_12',
        'tm_13',
        'tm_14',
        'rb_1',
        'rb_2',
        'rb_3',
        'rb_4',
        'rb_5'
    ];
}
