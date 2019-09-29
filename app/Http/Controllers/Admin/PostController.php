<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        return view('admin/post.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'user_id',
            3 =>'type',
            4 =>'id',
        );

        $totalData = Post::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  Post::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->orWhere('type', 'LIKE',"%{$search}%")
            ->orWhereHas('User', function($q) use ($search){
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Post::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('type', 'LIKE',"%{$search}%")
                ->orWhereHas('User', function($q) use ($search){
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $ava = url(parent::PublicPa().$post->avatar);

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['user_id'] = '<span class="badge badge-primary">'. $post->User->name .'</span>';
                $nestedData['type'] = '<span class="badge badge-secondary">'. $post->type .'</span>';
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
        $Post = Post::where('id' ,'=',$id)->first();
        if($Post == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$Post]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $Post = Post::where('id' ,'=',$id)->first();
        if($Post == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($Post->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $Post->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }

    public function postdata(Request $request){
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->rules($edit));
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            if ($request->get('button_action') == "insert") {
                DB::transaction(function()
                {
                    $Post = new Post();
                    $Post->name = Input::get('name');
                    $Post->tags = Input::get('tags');
                    $Post->description = Input::get('description');
                    $Post->type = Input::get('type');
                    $Post->body = Input::get('cbody');
                    $Post->slug = parent::slugify(Input::get('name'));
                    $Post->user_id = parent::CurrentID();
                    $Post->avatar = parent::upladImage(Input::file('img'),'Post');
                    $Post->save();
                    if( !$Post )
                    {
                        return response()->json(['error'=> 'Post not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','same_page' =>'0']);
            }
            else if ($request->get('button_action') == "edit"){

                DB::transaction(function()
                {
                    $Post = Post::where('id' ,'=',Input::get('id'))->first();
                    $Post->tags = Input::get('tags');
                    $Post->name = Input::get('name');
                    $Post->description = Input::get('description');
                    $Post->slug = parent::slugify(Input::get('name'));
                    $Post->type = Input::get('type');
                    $Post->body = Input::get('cbody');
                    if(Input::hasFile('img')){
                        //Remove Old
                        if($Post->avatar != 'Post/no.png'){
                            if(file_exists(public_path($Post->avatar))){
                                unlink(public_path($Post->avatar));
                            }
                        }
                        //Save avatar
                        $Post->avatar = parent::upladImage(Input::file('img'),'Post');
                    }
                    $Post->update();
                    if( !$Post )
                    {
                        return response()->json(['error'=> 'Post not updated']);
                    }
                });
                return response()->json(['success'=>'Updated Successfully','same_page' =>'0']);
            }
            else{
                return response()->json(['error'=> 'Has Error']);
            }
        }
    }

    private function rules($edit = null){
        $x= [
            'name' => 'required|string|min:3',
            'tags' => 'required|string|min:3',
            'cbody' => 'required|string',
            'description' => 'required|string|max:191',
            'type' => 'required|string|in:blog,page',
            'img' => 'required|mimes:png,jpg,jpeg',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['img'] ='nullable|mimes:png,jpg,jpeg';
        }
        return $x;
    }

    function countries(Request $request){
        $search = $request->search;
        $item = Countries::where('name','like', '%' .$search . '%')->get();
        return response()->json(['success'=>$item]);
    }


}
