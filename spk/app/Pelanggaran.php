<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    //
    protected $table = 'pelanggaran';
    protected $fillable = [
        'kriteria_id', 'pelanggaran', 'bobot'
    ];
}
