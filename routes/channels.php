<?php

Route::group(['middleware'=>'auth'],function (){


    Broadcast::channel('App.User.{id}', function ($user, $id) {
        return (int) $user->id === (int) $id;
    });

    Broadcast::channel('chat',function ($user){
        return ['name'=>$user->name];
    });

    Broadcast::channel('chat2',function (){
        return true;
    });

    Broadcast::channel('travel',function ($user){
        return ['name'=>$user->name];
    });


});
