<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['user_id', 'divisi_id','title','keterangan','detail','deathline','est','project_id','priority'];
}
