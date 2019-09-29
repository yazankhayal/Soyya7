<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident_Star_Travel extends Model
{
    public $table = "resident_star_travel";
    public $fillable = ['id',
        'star','resident_id','visitor_id','name',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function visitor(){
        return $this->belongsTo(User::class,'visitor_id','id');
    }

    public function resident(){
        return $this->belongsTo(User::class,'resident_id','id');
    }
}
