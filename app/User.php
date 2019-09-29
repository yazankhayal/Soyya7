<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function CheckRole($x){
        if($this->role == $x){
            return true;
        }
        return false;
    }

    public function Countries(){
        return $this->belongsTo(Countries::class,'countries_id','id');
    }

    public function Stars($x){
        $stars = Resident_Star_Travel::where('resident_id',$x)->get();
        $stars_sum = 0;
        if($stars->count() > 0){
            foreach ($stars as $star){
                $stars_sum = $stars_sum + $star->star;
            }
            $stars_count = $stars->count();
            $star_calcau = $stars_sum / $stars_count;
        }
        else{
            $star_calcau = 0;
        }
        return $star_calcau;
    }

}
