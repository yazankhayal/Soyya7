<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $table = "message";
    public $fillable = ['id',
        'message','resident_id','visitor_id',
        'travel_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function visitor(){
        return $this->belongsTo(User::class,'visitor_id','id');
    }
    public function resident(){
        return $this->belongsTo(User::class,'resident_id','id');
    }
    public function travel(){
        return $this->belongsTo(Travel::class,'travel_id','id');
    }
}
