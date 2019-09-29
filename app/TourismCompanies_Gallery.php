<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourismCompanies_Gallery extends Model
{
    public $table = "tourism_companies_gallery";

    public $fillable = ['id',
        'name','tourism_companies_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];

    public $primaryKey = 'id';


    public function TourismCompanies(){
        return $this->belongsTo(TourismCompanies::class,'tourism_companies_id','id');
    }

}
