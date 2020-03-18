<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['user_id','task_id','note','created_at','updated_at'];
}
