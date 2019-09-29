<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourismCompanies extends Model
{
    public $table = "tourism_companies";
    public $fillable = ['id',
        'name','avatar','slug',
        'email','phone',
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

    public function TourismCompanies_Gallery(){
        return $this->hasMany(TourismCompanies_Gallery::class,'tourism_companies_id','id');
    }


}
