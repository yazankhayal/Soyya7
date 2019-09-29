<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    public function index(){
        return view('admin/countries.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'two_char_code',
            3 =>'three_char_code',
            4 =>'id',
        );

        $totalData = Countries::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  Countries::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->orWhere('two_char_code', 'LIKE',"%{$search}%")
            ->orWhere('three_char_code', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Countries::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('two_char_code', 'LIKE',"%{$search}%")
                ->orWhere('three_char_code', 'LIKE',"%{$search}%")
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['two_char_code'] = $post->two_char_code;
                $nestedData['three_char_code'] = $post->three_char_code;
                $nestedData['options'] = "&emsp;<a class='btn_edit_current btn btn-success btn-sm' data-id='{$post->id}' title='SHOW' ><span style='color: #fff' class='fa fa-edit'></span></a>
                                          &emsp;<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='EDIT' ><span style='color: #fff' class='fa fa-trash'></span></a>";
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
        $user = Countries::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$user]);
    }


    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = Countries::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user->delete();
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
                // Start transaction
                DB::transaction(function()
                {
                    $user = new Countries();
                    $user->name = Input::get('name');
                    $user->two_char_code = Input::get('two_char_code');
                    $user->three_char_code = Input::get('three_char_code');
                    $user->save();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'Countries not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','same_page' =>'0']);
            }
            else if ($request->get('button_action') == "edit"){
                DB::transaction(function()
                {
                    $user = Countries::where('id' ,'=',Input::get('id'))->first();
                    $user->name = Input::get('name');
                    $user->two_char_code = Input::get('two_char_code');
                    $user->three_char_code = Input::get('three_char_code');
                    $user->update();
                    if( !$user )
                    {
                        return response()->json(['error'=> 'Countries not updated']);
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
            'two_char_code' => 'required|string',
            'three_char_code' => 'required|string',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['avatar'] ='nullable|mimes:png,jpg,jpeg';
        }
        return $x;
    }

}
