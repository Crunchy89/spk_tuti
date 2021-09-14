<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    //
    protected $table = 'data_kelas';
    protected $fillable = [
        'kelas_id', 'siswa_id'
    ];
}
