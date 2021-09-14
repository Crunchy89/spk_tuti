<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    //
    protected $table = 'data_kuisioner';
    protected $fillable = [
        'id_user', 'id_kriteria_1', 'id_kriteria_2', 'nilai'
    ];
}
