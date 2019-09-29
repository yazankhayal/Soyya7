<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    public $table = "travel";
    public $fillable = ['id',
        'name','avatar','slug',
        'countries_id','user_id	',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Countries(){
        return $this->belongsTo(Countries::class,'countries_id','id');
    }

    public function Gallery_Travel(){
        return $this->hasMany(Gallery_Travel::class,'travel_id','id');
    }


}
