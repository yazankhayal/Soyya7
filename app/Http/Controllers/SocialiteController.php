<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Exception;
use Auth;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class SocialiteController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->facebook_id != ''){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through facebook');
            }
            else{
                return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already ' . $user->email);
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =(string)\Uuid::generate();
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->type_login  = 'facebook';
            $newUser->code_active = '';
            $newUser->role = 3;
            $newUser->countries_id = Countries::limit(1)->orderby('created_at','desc')->first()->id;
            $newUser->active = 1;
            $newUser->phone = '123456789012';
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through facebook');
        }
    }

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->linkedin_id != ''){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through linkedin');
            }
            else{
                return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already ' . $user->email);
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =(string)\Uuid::generate();
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->type_login  = 'linkedin';
            $newUser->code_active = '';
            $newUser->role = 3;
            $newUser->countries_id = Countries::limit(1)->orderby('created_at','desc')->first()->id;
            $newUser->active = 1;
            $newUser->phone = '123456789012';
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through linkedin');
        }
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->google_id != ''){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through google');
            }
            else{
                return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already ' . $user->email);
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =(string)\Uuid::generate();
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->type_login  = 'google';
            $newUser->code_active = '';
            $newUser->role = 3;
            $newUser->countries_id = Countries::limit(1)->orderby('created_at','desc')->first()->id;
            $newUser->active = 1;
            $newUser->phone = '123456789012';
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through google');
        }
    }

    public function redirectToGitHub(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback(){
        try {
            $user = Socialite::driver('github')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->github_id != ''){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through github');
            }
            else{
                return redirect()->to('/login')->with('error','Make sure that you have registered before, because there is an email already ' . $user->email);
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =(string)\Uuid::generate();
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->type_login  = 'github';
            $newUser->code_active = '';
            $newUser->role = 3;
            $newUser->countries_id = Countries::limit(1)->orderby('created_at','desc')->first()->id;
            $newUser->active = 1;
            $newUser->phone = '123456789012';
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through github');
        }
    }
}
