<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\TourismCompanies_Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\TourismCompanies;
use Mail;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class TourismCompaniesController extends Controller
{
    public function index(){
        return view('admin/tourism_companies.index');
    }

    public function add_edit(){
        return view('admin/tourism_companies.add_edit');
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

        $totalData = TourismCompanies::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  TourismCompanies::where('id','LIKE',"%{$search}%")
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
            $totalFiltered = TourismCompanies::where('id','LIKE',"%{$search}%")
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
                $edit = route('tourism_companies.add_edit',['id'=>$post->id]);

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
        $TourismCompanies = TourismCompanies::where('id' ,'=',$id)->first();
        if($TourismCompanies == null){
            return response()->json(['error'=> 'Has Error']);
        }
        return response()->json(['success'=>$TourismCompanies]);
    }

    function deleted($id = null){
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $TourismCompanies = TourismCompanies::where('id' ,'=',$id)->first();
        if($TourismCompanies == null){
            return response()->json(['error'=> 'Has Error']);
        }

        if($TourismCompanies->id == parent::CurrentID()){
            return response()->json(['error'=> 'Do not delete yourself']);
        }

        $TourismCompanies->delete();
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
                    $TourismCompanies = new TourismCompanies();
                    $TourismCompanies->log = Input::get('lng');
                    $TourismCompanies->lat = Input::get('lat');
                    $TourismCompanies->name = Input::get('name');
                    $TourismCompanies->email = Input::get('email');
                    $TourismCompanies->phone = Input::get('phone');
                    $TourismCompanies->body = Input::get('cbody');
                    $TourismCompanies->slug = parent::slugify(Input::get('name'));
                    $TourismCompanies->description = Input::get('description');
                    $TourismCompanies->user_id = parent::CurrentID();
                    $TourismCompanies->countries_id = Input::get('countries_id');
                    $TourismCompanies->avatar = parent::upladImage(Input::file('img'),'TourismCompanies');
                    $TourismCompanies->save();
                    if( !$TourismCompanies )
                    {
                        return response()->json(['error'=> 'TourismCompanies not created']);
                    }
                });
                return response()->json(['success'=> 'Created Successfully','url'=>route('tourism_companies.index')]);
            }
            else if ($request->get('button_action') == "edit"){

                DB::transaction(function()
                {
                    $TourismCompanies = TourismCompanies::where('id' ,'=',Input::get('id'))->first();
                    $TourismCompanies->name = Input::get('name');
                    $TourismCompanies->email = Input::get('email');
                    $TourismCompanies->phone = Input::get('phone');
                    $TourismCompanies->log = Input::get('lng');
                    $TourismCompanies->body = Input::get('cbody');
                    $TourismCompanies->lat = Input::get('lat');
                    $TourismCompanies->slug = parent::slugify(Input::get('name'));
                    $TourismCompanies->description = Input::get('description');
                    $TourismCompanies->countries_id = Input::get('countries_id');
                    if(Input::hasFile('img')){
                        //Remove Old
                        if($TourismCompanies->avatar != 'TourismCompanies/no.png'){
                            if(file_exists(public_path($TourismCompanies->avatar))){
                                unlink(public_path($TourismCompanies->avatar));
                            }
                        }
                        //Save avatar
                        $TourismCompanies->avatar = parent::upladImage(Input::file('img'),'TourismCompanies');
                    }
                    $TourismCompanies->update();
                    if( !$TourismCompanies )
                    {
                        return response()->json(['error'=> 'TourismCompanies not updated']);
                    }
                });
                return response()->json(['success'=>'Updated Successfully','url'=>route('tourism_companies.index')]);
            }
            else{
                return response()->json(['error'=> 'Has Error']);
            }
        }
    }

    private function rules($edit = null){
        $x= [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email',
            'phone' => 'required|string|digits:12|regex:/[0-9]{12}/',
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
        $path = base_path(parent::url_base_path().'tourism_companies_gallery/'.$filename);
        if (file_exists($path)) {
            unlink($path);
        }
        $save = TourismCompanies_Gallery::where('name','=',$filename)->first();
        if($save == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $save->delete();
        return $filename;
    }

    public function file_deleted_by_id($id = null){
        $save = TourismCompanies_Gallery::where('id','=',$id)->first();
        $filename = $save->name;
        if($save == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $path = base_path(parent::url_base_path().'tourism_companies_gallery/'.$save->name);
        if (file_exists($path)) {
            unlink($path);
        }
        $save->delete();
        return response()->json(['success'=>'Done deleted photo']);
    }

    public function attachments($id = null){
        $item = TourismCompanies_Gallery::where('tourism_companies_id','=',$id)->get();
        return response()->json(['data'=>$item]);
    }

    public function tourism_companies_file(Request $request){
        $image = $request->file('file');
        $id = $request->id;
        if($id == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $user = TourismCompanies::where('id' ,'=',$id)->first();
        if($user == null){
            return response()->json(['error'=> 'Has Error']);
        }
        $imageName = $image->getClientOriginalName();
        $url = base_path(parent::url_base_path().'tourism_companies_gallery/');
        $image->move($url,$imageName);

        $save = new TourismCompanies_Gallery();
        $save->name = $imageName;
        $save->tourism_companies_id = $id;
        $save->save();

        return response()->json(['data'=>$imageName]);
    }


}
