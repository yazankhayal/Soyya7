<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident_Choice_Travel extends Model
{
    public $table = "resident_choice_travel";
    public $fillable = ['id','finish',
        'statues','resident_id','visitor_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,'resident_id','id');
    }

    public function visitor(){
        return $this->belongsTo(User::class,'visitor_id','id');
    }

    public function resident(){
        return $this->belongsTo(User::class,'resident_id','id');
    }
}
