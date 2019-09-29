<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    public $table = "contact_us";
    public $fillable = ['id',
        'email','email','subject',
        'message','read_it',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
