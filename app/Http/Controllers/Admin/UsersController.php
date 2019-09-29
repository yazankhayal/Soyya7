<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use Mail;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class UsersController extends Controller
{
    public function index(){
        return view('admin/users.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'email',
            3 =>'email',
            4 =>'name',
            5 =>'role',
            6 =>'id',
        );

        $totalData = User::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  User::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = User::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $ava = url(parent::PublicPa().$post->avatar);
                if($post->type_login != null){
                    $ava = $post->avatar;
                }

                $role = '';
                if($post->role == 1){
                    $role = 'Admin';
                }
                else if($post->role == 2){
                    $role = 'Resident';
                }
                else{
                    $role = 'Visitor';
                }

                $check = '';
                if($post->active == 1){
                    $check = 'checked';
                }

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['confirm_email'] = '<div class="text-center"><input data-id="'. $post->id .'" class="btn_confirm_email_current" type="checkbox" '.$check.'></div>';
                $nestedData['role'] = '<div class="badge badge-primary">'. $role .'</div>';
                $nestedData['avatar'] = "<img src='{$ava}' class='img-circle' style='width: 50px;height: 50px;'>";
                $nestedData['options'] = "&emsp;<a class='btn_edit_current btn btn-success btn-sm' data-id='{$post->id}' title='Edit' ><span style='color: #fff' class='fa fa-edit'></span></a>
                                          &emsp;<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='Delete' ><span style='color: #fff' class='fa fa-trash'></span></a>";
                $data[] = $nestedData;

            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    function getdataid($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = User::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$user]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = User::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($user->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $user->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }

    public function postdata(Request $request){
        $edit = $request->id;
        $password = $request->password;
        $validation = Validator::make($request->all(), $this->rules($edit,$password));
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            if ($request->get('button_action') == "insert") {
                DB::transaction(function()
                {
                    $user = new User();
                    $user->name = Input::get('name');
                    $user->countries_id = Input::get('countries_id');
                    $user->email = Input::get('email');
                    $user->phone = Input::get('phone');
                    $user->role = Input::get('role');
                    if(Input::get('password') != null){
                        $user->password = bcrypt(Input::get('password'));
                    }
                    $user->avatar = parent::upladImage(Input::file('avatar'),'avatar');
                    $user->save();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'User not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','same_page' =>'0']);
            }
            else if ($request->get('button_action') == "edit"){

                DB::transaction(function()
                {
                    $user = User::where('id' ,'=',Input::get('id'))->first();
                    $user->name = Input::get('name');
                    $user->countries_id = Input::get('countries_id');
                    $user->email = Input::get('email');
                    $user->phone = Input::get('phone');
                    $user->role = Input::get('role');
                    if(Input::get('password') != null){
                        $user->password = bcrypt(Input::get('password'));
                    }
                    if(Input::hasFile('avatar')){
                        //Remove Old
                        if($user->avatar != 'avatar/no.png'){
                            if(file_exists(public_path($user->avatar))){
                                unlink(public_path($user->avatar));
                            }
                        }
                        //Save avatar
                        $user->avatar = parent::upladImage(Input::file('avatar'),'avatar');
                    }
                    $user->update();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'User not updated']);
                    }
                });
                return response()->json(['success'=>'Updated Successfully','same_page' =>'0']);
            }
            else{
                return response()->json(['error'=> 'Has Error']);
            }
        }
    }

    private function rules($edit = null,$pass = null){
        $x= [
            'name' => 'required|string|min:3',
            'countries_id' => 'required|integer|min:1',
            'email' => 'required|string|email|unique:users,email,'.$edit,
            'phone' => 'required|string|digits:12|regex:/[0-9]{12}/',
            'role' => 'required|integer|in:1,2,3',
            'avatar' => 'required|mimes:png,jpg,jpeg',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['avatar'] ='nullable|mimes:png,jpg,jpeg';
            $x['password'] ='nullable|string|min:6|confirmed';
        }
        else{
            $x['password'] ='required|string|min:6|confirmed';
        }

        if($pass != null){
            $x['password'] ='required|string|min:6|confirmed';
        }

        return $x;
    }

    function confirm_email(Request $request){
        $id = $request->id;
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = User::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        if($user->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not active yourself']);
        }
        if($user->active == 1){
            $user->active = 0;
            $user->update();
            return response()->json(['error'=>'Account user not verify']);
        }
        else{
            $user->active = 1;
            $user->update();
            return response()->json(['success'=>'Account user verify']);
        }
    }


}
