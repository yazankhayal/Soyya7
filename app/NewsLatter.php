<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLatter extends Model
{
    public $table = "newslatter";
    public $fillable = ['id',
        'email',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
