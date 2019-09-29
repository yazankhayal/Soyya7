<?php

namespace App\Providers;

use App\Partner;
use App\Post;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view)
        {
            $geturlphoto = '/';
            $user = Auth::user();
            $user_dashboard_link = '';
            $user_dashboard_name = '';
            $setting = Setting::first();
            $pages = Post::where('type','page')->orderby('id','desc')->get();
            $blog_footer = Post::where('type','blog')->limit(3)->orderByRaw("RAND()")->get();
            $gallery_footer = Post::where('type','blog')->limit(9)->select([
                'name','avatar'
            ])->orderByRaw("RAND()")->get();

            if(Auth::user() == null){
                $user = null;
                $user_dashboard_name = null;
                $user_dashboard_link = null;
            }
            else{
                if($user->role == 1){
                    $user_dashboard_name = 'Dashboard';
                    $user_dashboard_link = route('dashboard_admin.index');
                }
                else{
                    $user_dashboard_name = 'Profile';
                    $user_dashboard_link = route('profile',['email'=>$user->email,'id'=>$user->id]);
                }
            }

            $view
                ->with('setting',$setting)
                ->with('gallery_footer',$gallery_footer)
                ->with('blog_footer',$blog_footer)
                ->with('pages',$pages)
                ->with('user_dashboard_link',$user_dashboard_link)
                ->with('user_dashboard_name',$user_dashboard_name)
                ->with('user',$user)
                ->with('get_url_photo', $geturlphoto );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
