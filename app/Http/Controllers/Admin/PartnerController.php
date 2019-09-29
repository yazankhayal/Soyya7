<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function index(){
        return view('admin/partner.index');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'avatar',
            3 =>'link',
            4 =>'id',
        );

        $totalData = Partner::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $Partners =  Partner::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->orWhere('link', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Partner::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('link', 'LIKE',"%{$search}%")
                ->count();
        }


        $data = array();
        if(!empty($Partners))
        {
            foreach ($Partners as $Partner)
            {
                $ava = url(parent::PublicPa().$Partner->avatar);

                $nestedData['id'] = $Partner->id;
                $nestedData['name'] = $Partner->name;
                $nestedData['link'] = '<span class="badge badge-primary">'. $Partner->link .'</span>';
                $nestedData['avatar'] = "<img src='{$ava}' class='img-circle' style='width: 50px;height: 50px;'>";
                $nestedData['options'] = "&emsp;<a class='btn_edit_current btn btn-success btn-sm' data-id='{$Partner->id}' title='Edit' ><span style='color: #fff' class='fa fa-edit'></span></a>
                                          &emsp;<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$Partner->id}' title='Delete' ><span style='color: #fff' class='fa fa-trash'></span></a>";
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
        $Partner = Partner::where('id' ,'=',$id)->first();
        if($Partner == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$Partner]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $Partner = Partner::where('id' ,'=',$id)->first();
        if($Partner == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($Partner->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $Partner->delete();
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
                    $Partner = new Partner();
                    $Partner->name = Input::get('name');
                    $Partner->link = Input::get('link');
                    $Partner->avatar = parent::upladImage(Input::file('img'),'Partner');
                    $Partner->save();
                    if( !$Partner )
                    {
                        return response()->json(['error'=> 'Partner not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','same_page' =>'0']);
            }
            else if ($request->get('button_action') == "edit"){

                DB::transaction(function()
                {
                    $Partner = Partner::where('id' ,'=',Input::get('id'))->first();
                    $Partner->name = Input::get('name');
                    $Partner->link = Input::get('link');
                    if(Input::hasFile('img')){
                        //Remove Old
                        if($Partner->avatar != 'Partner/no.png'){
                            if(file_exists(public_path($Partner->avatar))){
                                unlink(public_path($Partner->avatar));
                            }
                        }
                        //Save avatar
                        $Partner->avatar = parent::upladImage(Input::file('img'),'Partner');
                    }
                    $Partner->update();
                    if( !$Partner )
                    {
                        return response()->json(['error'=> 'Partner not updated']);
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
            'link' => 'required|string',
            'img' => 'required|mimes:png,jpg,jpeg',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['img'] ='nullable|mimes:png,jpg,jpeg';
        }
        return $x;
    }

}
