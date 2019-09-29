<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model
{
    public $table = "comment_page";
    public $fillable = ['id',
        'name','post_id',
        'approve','user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
