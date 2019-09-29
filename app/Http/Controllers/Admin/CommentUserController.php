<?php

namespace App\Http\Controllers\Admin;

use App\Comment_post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CommentUserController extends Controller
{
    public function index(){
        return view('admin/comment_users.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'post_id',
            3 =>'user_id',
            4 =>'approve',
            5 =>'id',
        );

        $totalData = Comment_post::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  Comment_post::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->orWhere('approve', 'LIKE',"%{$search}%")
            ->orWhereHas('User', function($q) use ($search){
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('Post', function($q) use ($search){
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Comment_post::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('approve', 'LIKE',"%{$search}%")
                ->orWhereHas('User', function($q) use ($search){
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('Post', function($q) use ($search){
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $approve = 'No approve';
                $approve_class = 'danger';
                if($post->approve == 1){
                    $approve = 'Approve';
                    $approve_class = 'success';
                }

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['post_id'] = '<a href="'. route('blog_view',['slug'=>$post->post->slug,'id'=>$post->post->id]) .'" class="badge badge-primary">'.$post->post->name.'</a>';
                $nestedData['user_id'] = '<a href="'. route('profile',['email'=>$post->user->email,'id'=>$post->user->id]) .'" class="badge badge-primary">'.$post->user->name.'</a>';
                $nestedData['approve'] = "<div class=\"dropdown\">
                                      <button class=\"btn btn-$approve_class dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">$approve</button>
                                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                        <a class=\"btn_approve_yes dropdown-item\" data-id=\"$post->id\">Yes</a>
                                        <a class=\"btn_approve_no dropdown-item\" data-id=\"$post->id\">No</a>
                                      </div>
                                    </div>";
                $nestedData['options'] = "<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='Delete' ><span style='color: #fff' class='fa fa-trash'></span></a>";
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
        $Comment_post = Comment_post::where('id' ,'=',$id)->first();
        if($Comment_post == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$Comment_post]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $Comment_post = Comment_post::where('id' ,'=',$id)->first();
        if($Comment_post == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($Comment_post->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $Comment_post->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }

    function approve(Request $request){
        $id = $request->id;
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $Comment_post = Comment_post::where('id' ,'=',$id)->first();
        if($Comment_post == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($request->type == "yes"){
            if($Comment_post->approve == 1){
                return response()->json(['error'=>'Comment_post already approve']);
            }
            else{
                $Comment_post->approve = 1;
                $Comment_post->update();
                return response()->json(['success'=>'Comment_post approved']);
            }
        }
        else{
            if($Comment_post->approve == 1){
                $Comment_post->approve = 0;
                $Comment_post->update();
                return response()->json(['success'=>'Comment_post not approve']);
            }
            else{
                return response()->json(['error'=>'Comment_post already not approve']);
            }
        }

    }


}
