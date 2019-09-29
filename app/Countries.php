<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public $table = "countries";
    public $fillable = ['id',
        'name','two_char_code',
        'three_char_code',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
