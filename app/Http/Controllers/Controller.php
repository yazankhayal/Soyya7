<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upladImage($request, $dir = 'user'){
        $img = $request;
        $imageName = time().'.'.$img->getClientOriginalExtension();
        $direction = public_path('/'.$dir.'/');
        $img->move($direction,$imageName);
        return $saveImge = $dir.'/'.$imageName;
    }

    public function create_slug($x){
        return str_replace(' ', '-', $x);
    }

    public function create_keywords($x){
        return $x;
    }

    public function url_link (){
        return '/';
    }

    public function url_base_path (){
        return '/public/';
    }

    public function RandomOrderId($n){
        $domain2 ="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";
        $domain ="0123456789";
        $len = strlen($domain);
        $generated_string = "";
        for ($i = 0; $i < $n; $i++){
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        return $generated_string;
    }

    public function PublicPa(){
        return '/';
    }

    public function CurrentID(){
        return Auth::user()->id;
    }

    public function ReturenYearPar($x){
        if($x != null){
            $splitName = explode('-',$x, 3);
            return $splitName[0];
        }
    }

    public function ReturenMonthPar($x){
        if($x != null){
            $splitName = explode('-',$x, 3);
            return $splitName[1];
        }
    }

    public function ReturenDayPar($x){
        if($x != null){
            $splitName = explode('-',$x, 3);
            return $splitName[2];
        }
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
