<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $table = "partner";
    public $fillable = ['id',
        'name','avatar','link',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
