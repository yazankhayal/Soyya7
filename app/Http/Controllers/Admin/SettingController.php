<?php

namespace App\Http\Controllers\Admin;


use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;

class SettingController extends Controller
{
    public function index(){
        return view('admin/setting.index');
    }

    function getdata()
    {
        $items = Setting::first();
        return response()->json(['data'=> $items]);
    }

    public function postdata(Request $request){
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->rules($edit));
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $items = Setting::first();
            if($items == null){
                DB::transaction(function()
                {
                    $user = new Setting();
                    $user->email = Input::get('email');
                    $user->phone = Input::get('phone');
                    $user->description =Input::get('description');
                    $user->name = Input::get('name');
                    $user->location = Input::get('location');
                    $user->script = Input::get('script');
                    $user->logo = parent::upladImage(Input::file('img'),'setting');
                    $user->save();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'Setting not created']);
                    }
                });
                return response()->json(['success'=>'Created Successfully','same_page'=>'1']);
            }
            else{
                DB::transaction(function()
                {
                    $user = Setting::where('id' ,'=',Input::get('id'))->first();
                    $user->email = Input::get('email');
                    $user->phone = Input::get('phone');
                    $user->description =Input::get('description');
                    $user->name = Input::get('name');
                    $user->location = Input::get('location');
                    $user->script = Input::get('script');
                    if(Input::hasFile('img')){
                        //Remove Old
                        if($user->logo != 'setting/no.png'){
                            if(file_exists(public_path($user->logo))){
                                unlink(public_path($user->logo));
                            }
                        }
                        //Save avatar
                        $user->logo = parent::upladImage(Input::file('img'),'setting');
                    }
                    $user->update();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'Setting not updated']);
                    }
                });
                return response()->json(['success'=>'Updated Successfully','same_page'=>'1']);
            }
        }
    }

    private function rules($edit = null){
        $x= [
            'email' => 'required|email|string|min:3',
            'phone' => 'required|integer',
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'location' => 'required|string|min:3',
            'script' => 'nullable|string',
            'img' => 'required|mimes:png,jpg,jpeg',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['img'] ='nullable|mimes:png,jpg,jpeg';
        }
        return $x;
    }

}
