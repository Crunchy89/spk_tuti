<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPelanggaran extends Model
{
    //
    protected $table = 'data_pelanggaran';
    protected $fillable = [
        'siswa_id', 'pelanggaran_id'
    ];
}
