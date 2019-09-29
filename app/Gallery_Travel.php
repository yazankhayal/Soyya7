<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery_Travel extends Model
{
    public $table = "travel_gallery";

    public $fillable = ['id',
        'name','travel_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];

    public $primaryKey = 'id';


    public function Travel(){
        return $this->belongsTo(Travel::class,'travel_id','id');
    }

}
