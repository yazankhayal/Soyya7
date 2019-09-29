<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikePost extends Model
{
    public $table = "like_post";

    public $fillable = ['id',
        'ip_user','post_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];

    public $primaryKey = 'id';


    public function Post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
