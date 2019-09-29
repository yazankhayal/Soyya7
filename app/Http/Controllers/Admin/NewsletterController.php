<?php

namespace App\Http\Controllers\Admin;

use App\NewsLatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function index(){
        return view('admin/newsletter.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'email',
            3 =>'id',
        );

        $totalData = NewsLatter::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  NewsLatter::where('id','LIKE',"%{$search}%")
            ->orWhere('email', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = NewsLatter  ::where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['email'] = $post->email;
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


    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = NewsLatter::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }


    function deleted_all($id = null){
        if(NewsLatter::count() == 0){
            return response()->json(['error'=>'No data to Deleted']);
        }
        else{
            DB::table('contact_us')->delete();
            return response()->json(['error'=>'Deleted all Successfully']);
        }
    }

}
