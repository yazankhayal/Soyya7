<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = "post";
    public $fillable = ['id',
        'name','avatar','slug',
        'description','body',
        'type','user_id	',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Comment_Count(){
        return $this->hasMany(Comment_post::class,'post_id','id')->where('approve','=', true);
    }

    public function Eye_Count(){
        return $this->hasMany(EyePost::class,'post_id','id');
    }

    public function Like_Count(){
        return $this->hasMany(LikePost::class,'post_id','id');
    }

    public function Like_Check($x){
        return $this->hasMany(LikePost::class,'post_id','id')->where('post_id','=', $x)->where('ip_user','=',\Request::ip());
    }
}
