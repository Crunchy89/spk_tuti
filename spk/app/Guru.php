<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    //
    protected $table = 'guru';
    protected $fillable = [
        'nama_guru', 'user_id'
    ];
    public function guru_user()
    {
        return $this->belongsTo(User::class);
    }
}
