<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'divisi';
    protected $fillable = ['user_id', 'divisi'];
}
