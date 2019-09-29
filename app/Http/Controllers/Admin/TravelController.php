<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\Gallery_Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Travel;
use Mail;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class TravelController extends Controller
{
    public function index(){
        return view('admin/travel.index');
    }

    public function add_edit(){
        return view('admin/travel.add_edit');
    }

    function getdata(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'user_id',
            3 =>'countries_id',
            4 =>'id',
        );

        $totalData = Travel::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  Travel::where('id','LIKE',"%{$search}%")
            ->orWhere('name', 'LIKE',"%{$search}%")
            ->orWhereHas('User', function($q) use ($search){
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('Countries', function($q) use ($search){
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Travel::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhereHas('User', function($q) use ($search){
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('Countries', function($q) use ($search){
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('countries_id', 'LIKE',"%{$search}%")
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $ava = url(parent::PublicPa().$post->avatar);
                $edit = route('travel.add_edit',['id'=>$post->id]);

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['user_id'] = '<span class="badge badge-primary">'. $post->User->name .'</span>';
                $nestedData['countries_id'] = '<span class="badge badge-secondary">'. $post->Countries->name .'</span>';
                $nestedData['avatar'] = "<img src='{$ava}' class='img-circle' style='width: 50px;height: 50px;'>";
                $nestedData['options'] = "&emsp;<a class='btn_gallery_current btn btn-warning btn-sm' data-id='{$post->id}' title='Gallery' ><span style='color: #fff' class='fa fa-image'></span></a>
                                           &emsp;<a class=' btn btn-success btn-sm' href='{$edit}' title='Edit' ><span style='color: #fff' class='fa fa-edit'></span></a>
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
        $Travel = Travel::where('id' ,'=',$id)->first();
        if($Travel == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$Travel]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $Travel = Travel::where('id' ,'=',$id)->first();
        if($Travel == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($Travel->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $Travel->delete();
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
                    $Travel = new Travel();
                    $Travel->log = Input::get('lng');
                    $Travel->lat = Input::get('lat');
                    $Travel->name = Input::get('name');
                    $Travel->body = Input::get('cbody');
                    $Travel->slug = parent::slugify(Input::get('name'));
                    $Travel->description = Input::get('description');
                    $Travel->user_id = parent::CurrentID();
                    $Travel->countries_id = Input::get('countries_id');
                    $Travel->avatar = parent::upladImage(Input::file('img'),'travel');
                    $Travel->save();
                    if( !$Travel )
                    {
                        return response()->json(['error'=> 'Travel not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','url'=>route('travel.index')]);
            }
            else if ($request->get('button_action') == "edit"){

                DB::transaction(function()
                {
                    $Travel = Travel::where('id' ,'=',Input::get('id'))->first();
                    $Travel->name = Input::get('name');
                    $Travel->log = Input::get('lng');
                    $Travel->body = Input::get('cbody');
                    $Travel->lat = Input::get('lat');
                    $Travel->slug = parent::slugify(Input::get('name'));
                    $Travel->description = Input::get('description');
                    $Travel->countries_id = Input::get('countries_id');
                    if(Input::hasFile('img')){
                        //Remove Old
                        if($Travel->avatar != 'travel/no.png'){
                            if(file_exists(public_path($Travel->avatar))){
                                unlink(public_path($Travel->avatar));
                            }
                        }
                        //Save avatar
                        $Travel->avatar = parent::upladImage(Input::file('img'),'travel');
                    }
                    $Travel->update();
                    if( !$Travel )
                    {
                        return response()->json(['error'=> 'Travel not updated']);
                    }
                });
                return response()->json(['success'=>'Updated Successfully','url'=>route('travel.index')]);
            }
            else{
                return response()->json(['error'=> 'Has Error']);
            }
        }
    }

    private function rules($edit = null){
        $x= [
            'name' => 'required|string|min:3',
            'lat' => 'required|string|min:3',
            'cbody' => 'required|string',
            'lng' => 'required|string|min:3',
            'description' => 'required|string|max:191',
            'countries_id' => 'required|integer|min:3',
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

    public function file_deleted(Request $request){
        $filename =  $request->get('filename');
        $path = base_path(parent::url_base_path().'travel_gallery/'.$filename);
        if (file_exists($path)) {
            unlink($path);
        }
        $save = Gallery_Travel::where('name','=',$filename)->first();
        if($save == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $save->delete();
        return $filename;
    }

    public function file_deleted_by_id($id = null){
        $save = Gallery_Travel::where('id','=',$id)->first();
        $filename = $save->name;
        if($save == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $path = base_path(parent::url_base_path().'travel_gallery/'.$save->name);
        if (file_exists($path)) {
            unlink($path);
        }
        $save->delete();
        return response()->json(['success'=>'Done deleted photo']);
    }

    public function attachments($id = null){
        $item = Gallery_Travel::where('travel_id','=',$id)->get();
        return response()->json(['data'=>$item]);
    }

    public function travel_file(Request $request){
        $image = $request->file('file');
        $id = $request->id;
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = Travel::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $imageName = $image->getClientOriginalName();
        $url = base_path(parent::url_base_path().'travel_gallery/');
        $image->move($url,$imageName);

        $save = new Gallery_Travel();
        $save->name = $imageName;
        $save->travel_id = $id;
        $save->save();

        return response()->json(['data'=>$imageName]);
    }


}
