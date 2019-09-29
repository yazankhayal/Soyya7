<?php

namespace App\Http\Controllers;

use App\Comment_post;
use App\ContactUS;
use App\Countries;
use App\Events\ChatEvent;
use App\Events\ChoiceTravelEvent;
use App\EyePost;
use App\Gallery_Travel;
use App\LikePost;
use App\Message;
use App\NewsLatter;
use App\Partner;
use App\Post;
use App\Resident_Choice_Travel;
use App\Resident_Star_Travel;
use App\Travel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mail;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class WelcomeController extends Controller
{
    public function home_page(){
        $slider = Travel::limit(5)->orderByRaw("RAND()")->get();
        $popular = Travel::limit(15)->orderByRaw("RAND()")->get();
        $Resident = User::where('role',2)->orderby("id",'desc')->get();
        $blog = Post::where('type','blog')->limit(3)->orderByRaw("RAND()")->get();
        $partner = Partner::orderby("id",'desc')->get();
        return view('home_page',compact('slider','popular','Resident','blog','partner'));
    }

    public function new_user(){
        return view('auth.register');
    }

    function countries(Request $request){
        $item = Countries::get();
        return response()->json(['success'=>$item]);
    }

    public function post_new_user(Request $request){
        $validation = Validator::make($request->all(),[
            'countries_id' => 'required|integer|min:1',
            'role' => 'required|string|in:Visitor,Resident',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|integer|digits:12|regex:/[0-9]{12}/',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $uuid =(string)\Uuid::generate();

            $user = new User();
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->code_active = $uuid;
            if($request->role == 'Resident'){
                $user->role = 2;
            }
            else{
                $user->role = 3;
            }
            $user->countries_id = $request->countries_id;
            $user->phone = $request->phone;
            $user->save();


            $from_email = env('MAIL_USERNAME');

            $to_name = $request->name;
            $to_email = $request->email;

            $link = env('APP_URL') .'/active_account/?email='.$to_email.'&code='.$uuid;

            $data = array('name' => $request->name,"link"=> $link, "email" => $request->email,);

            Mail::send(['html'=>'emails.active'], $data, function($message) use ($to_name, $to_email,$from_email) {
                $message->to($to_email, $to_name)
                    ->subject('Activision account');
                $message->from($from_email,'Activision account');
            });

            return response()->json(['success'=>'Thank you for registration , Please go to E-Mail to active account','same_page' =>'1']);
        }
    }

    public function active_account(Request $request){
        $email = $request->email;
        $code = $request->code;

        if($email == null || $code == null){
            return redirect()->to('/login');
        }

        $user = User::where('email',$email)->first();

        if($user  == null){
            return redirect()->to('/login');
        }

        if($user->code_active == null || $user->code_active == ''){
            return redirect()->to('/login');
        }

        if($user->active == 1){
            return redirect()->to('/login')->with('error','The activision already activated');
        }


        $user->code_active = '';
        $user->active = 1;
        $user->update();
        return redirect()->to('/login')->with('success','The activision completed');

    }

    public function blog(Request $request){
        $q = '%' . $request->search. '%';
        $items = Post::where('type','blog')->where('name','like',$q)->orderby('id','desc')->paginate(10,['*'],'page');
        $recent2 = Post::where('type','blog')->limit(5)->orderByRaw("RAND()")->get();
        $recent_tags = Post::where('type','blog')->select('tags')->get();
        return view('blog',compact('items','recent2','recent_tags'));
    }

    public function blog_view($slug = null,$id = null){
        $item = Post::where([
            'id' => $id,
            'slug' => $slug,
        ])->first();
        if($item == null){
            return redirect()->to('/');
        }
        $comment = Comment_post::where([
            'post_id' => $item->id,
            'approve' => true
        ])->get();
        $recent = Post::where('type','blog')->where('id','!=',$id)->orderByRaw("RAND()")->limit(2)->get();
        $recent2 = Post::where('type','blog')->where('id','!=',$id)->orderByRaw("RAND()")->limit(5)->get();

        $clientIP = \Request::ip();

        if(EyePost::where([
            'ip_user' => $clientIP,
            'post_id' => $item->id
        ])->first() == null){
            $eye = new EyePost();
            $eye->ip_user = $clientIP;
            $eye->post_id = $item->id;
            $eye->save();
        }
        return view('blog_view',compact('item','comment','recent','recent2'));
    }

    public function like_post(Request $request){
        $id = $request->id;
        $slug = $request->slug;
        $item = Post::where([
            'id' => $id,
            'slug' => $slug,
        ])->first();
        if($item == null){
            return response()->json(['error'=>'Has Error']);
        }
        $clientIP = \Request::ip();

        if(LikePost::where([
                'ip_user' => $clientIP,
                'post_id' => $item->id
            ])->first() == null){
            $eye = new LikePost();
            $eye->ip_user = $clientIP;
            $eye->post_id = $item->id;
            $eye->save();
        }
        else{
            $remove = LikePost::where([
                'ip_user' => $clientIP,
                'post_id' => $item->id
            ])->first();
            if($remove == null){
                return response()->json(['error'=>'Has Error']);
            }
            $remove->delete();
            return response()->json(['error'=>'Remove Like']);
        }
        return response()->json(['success'=>'Like it']);
    }

    public function travelez(){
        $items = Travel::orderby('created_at','desc')->paginate(10);
        return view('travel',compact('items'));
    }

    public function travel_view($slug = null,$id = null){
        $item = Travel::where([
            'id' => $id,
            'slug' => $slug,
        ])->first();
        if($item == null){
            return redirect()->to('/');
        }
        $users = User::where([
            'role' => '2',
            'countries_id' => $item->countries_id
        ])->orderby('created_at','desc')->paginate(10);
        $gallery = Gallery_Travel::where('travel_id',$item->id)->get();
        return view('travel_view',compact('item','users','gallery'));
    }

    public function profile($email = null,$id = null){
        $item = User::where([
            'id' => $id,
            'email' => $email,
        ])->first();
        if($item == null){
            return redirect()->to('/');
        }
        if(Auth::user() != null){
            $resident_choice_travel = Resident_Choice_Travel::
                where('resident_id',$item->id)
                ->where('finish','=', '0')
                ->orwhere('resident_id',Auth::user()->id)
                ->where('finish','=', '0')
                ->first();
        }
        else{
            $resident_choice_travel = null;
        }
        $stars = Resident_Star_Travel::where('resident_id',$item->id)->paginate(10);
        $stars2 = Resident_Star_Travel::where('resident_id',$item->id)->get();
        $stars_sum = 0;
        if($stars2->count() > 0){
            foreach ($stars2 as $star){
                $stars_sum = $stars_sum + $star->star;
            }
            $stars_count = $stars->count();
            $star_calcau = $stars_sum / $stars_count;
        }
        else{
            $star_calcau = 0;
        }
        return view('profile',compact('item','resident_choice_travel','star_calcau','stars'));
    }

    public function comment_post(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'current' => 'required|string',
            'post_id' => 'required|integer|min:1',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $save = new Comment_post();
            $save->post_id = $request->post_id;
            $save->name = $request->name;
            $save->user_id = parent::CurrentID();
            $save->save();
            $url =  $request->current;
            return response()->json(['success'=>'Thank you for comment , It will be submitted to the administration for admission','url' =>$url]);
        }
    }

    public function message_travel(Request $request){
        $resident = $request->resident;
        $limit = $request->limit;
        return $item =  Message::
            with('user')
            ->where('visitor_id','=',Auth::user()->id)
            ->where('resident_id','=',$resident)
            ->orwhere('resident_id','=',Auth::user()->id)
            ->where('visitor_id','=',$resident)
            ->with('visitor')
            ->with('resident')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function send_message(Request $request){
        $message = $request->message;

        $user = User::find(Auth::id());

        $save = new Message();
        $save->message = $message;
        $save->visitor_id = parent::CurrentID();
        $save->resident_id = $request->resident;
        $save->travel_id = 1;
        $save->read_it = 0;
        $save->save();

        event(new ChatEvent($save,$user));
    }

    public function read_send_message(Request $request){
        $read = Message::where('id',$request->id)
            ->where('visitor_id','=',Auth::user()->id)
            ->orwhere('resident_id','=',Auth::user()->id)
            ->first();
        if($read != null){
            if($read->read_it == 0){
                $read->read_it = 1;
                $read->update();
            }
        }
    }

    public function notification(Request $request){
        $read = Message::
            where('visitor_id','=',Auth::user()->id)
            ->where('read_it','=',0)
            ->orwhere('resident_id','=',Auth::user()->id)
            ->where('read_it','=',0)
            ->with('visitor')
            ->with('resident')
            ->get();
        return $read;
    }

    public function read_it_message(Request $request){
        $read = Message::
            where('id','=',$request->id)
            ->first();
        if($read != null){
            $read->read_it = 1;
            $read->update();
        }
        return $read;
    }

    public function contact_us(){
        return view('contact_us');
    }


    public function post_contact_us(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email',
            'subject' => 'required|string|max:125',
            'comments' => 'required|string',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{

            $save = new ContactUS();
            $save->email = $request->email;
            $save->subject = $request->subject;
            $save->name = $request->name;
            $save->message = $request->subject;
            $save->read_it = false;
            $save->save();
            return response()->json(['success'=>'Thank you for comment , It will be submitted to the administration for admission','same_page'=>'1']);
        }
    }

    public function newslatter(Request $request){
        $validation = Validator::make($request->all(),[
            'email' => 'required|string|email|unique:users,email',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{

            $save = new NewsLatter();
            $save->email = $request->email;
            $save->save();
            return response()->json(['success'=>'Thank you for Register Newsletter ','same_page'=>'1']);
        }
    }

    public function update_info(Request $request){
        $edit2 = Auth::user()->id;
        $password = $request->password;
        $validation = Validator::make($request->all(),$this->rules_update_info($edit2,$password));
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $edit = Auth::user();
            $edit->name = $request->name;
            $edit->phone = $request->phone;
            if(Input::get('password') != null){
                $edit->password = bcrypt(Input::get('password'));
            }
            if(Input::hasFile('avatar')){
                //Remove Old
                if($edit->avatar != 'avatar/no.png'){
                    if(file_exists(public_path($edit->avatar))){
                        unlink(public_path($edit->avatar));
                    }
                }
                //Save avatar
                $edit->avatar = parent::upladImage(Input::file('avatar'),'avatar');
            }
            if($request->role == 'Resident'){
                $edit->role = 2;
            }
            else{
                $edit->role = 3;
            }
            $edit->update();
            return response()->json(['success'=>'Updated Successfully','same_page'=>'1']);
        }
    }

    private function rules_update_info($edit = null,$pass = null){
        $x= [
            'name' => 'required|string|min:3',
            'countries_id' => 'required|integer|min:1',
            'phone' => 'required|string|digits:12|regex:/[0-9]{12}/',
            'avatar' => 'required|mimes:png,jpg,jpeg',
            'role' => 'required|string|in:Visitor,Resident',
        ];
        if($edit != null){
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

    public function resident(){
        $items = User::where('role','2')->orderby('id','desc')->paginate(10);
        return view('resident',compact('items'));
    }

    public function continue_choice_your_travel(Request $request){
        $validation = Validator::make($request->all(),[
            'resident_id' => 'required|integer|min:1',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{

            $residenr = User::where('id',$request->resident_id)->first();
            if($residenr == null){
                return response()->json(['error'=>'Has error - no user']);
            }

            $save = new Resident_Choice_Travel();
            $save->visitor_id = parent::CurrentID();
            $save->resident_id = $request->resident_id;
            $save->statues = 1;
            $save->save();

            $from_email = env('MAIL_USERNAME');

            $to_name = $residenr->name;
            $to_email = $residenr->email;

            $link = env('APP_URL') .'/profile/'.Auth::user()->name.'/'.Auth::user()->id;

            $data = array('name_help' => Auth::user()->name,'name' => $to_name,"link"=> $link);

            Mail::send(['html'=>'emails.choice_travel'], $data, function($message) use ($to_name, $to_email,$from_email) {
                $message->to($to_email, $to_name)
                    ->subject('Congratulations');
                $message->from($from_email,'Congratulations');
            });

            event(new ChoiceTravelEvent($save,$residenr));

            return response()->json(['success'=>'Resident selection has been successful Please wait for it to be approved it','same_page'=>'1']);
        }
    }

    public function btn_ok_cancel_choice(Request $request){
        $residenr = Auth::user();
        $item = Resident_Choice_Travel::where('id',$request->id)->first();
        if($item == null){
            return response()->json(['error'=>'Has error - no data']);
        }

        if($request->type == 'ok'){
            $item->statues = 2;
            $item->update();
            event(new ChoiceTravelEvent($item,$residenr));
            return response()->json(['success'=>'Your accepted','url'=>$request->url]);
        }
        else if($request->type == 'cancel'){
            $item->delete();
            return response()->json(['error'=>'Your rejected','url'=>$request->url]);
        }
        else if($request->type == 'finish'){
            $item->statues = 3;
            $item->finish = 1;
            $item->update();
            return response()->json(['success'=>'Your Finish tour']);
        }

    }

    public function Star_Choice_your_travel(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'id_star_resident_id' => 'required|integer|min:1',
            'star_value' => 'required|integer|in:1,2,3,4,5',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $item = User::where('id',$request->id_star_resident_id)->first();
            if($item == null){
                return response()->json(['error'=>'Has error - no data']);
            }
            $save = new Resident_Star_Travel();
            $save->star = $request->star_value;
            $save->name = $request->name;
            $save->resident_id = $request->id_star_resident_id;
            $save->visitor_id = parent::CurrentID();
            $save->save();
            return response()->json(['success'=>'Thank you for your evaluation to the evaluator','url'=>$request->current]);
        }
    }

    public function alerts_resident(Request $request){
        $type = $request->type;
        if($type == 2){
            $items = Resident_Choice_Travel::where([
                'finish' => 0,
                'resident_id' => parent::CurrentID(),
                'statues' => 1,
            ])
                ->with('visitor')
                ->with('resident')
                ->get();
        }
        else{
            $items = Resident_Choice_Travel::where([
                'finish' => 0,
                'visitor_id' => parent::CurrentID(),
                'statues' => 2,
            ])
                ->with('visitor')
                ->with('resident')
                ->get();
        }
        return $items;
    }

    public function order(){
        return view('orders');
    }

    function my_orders_get_data(Request $request)
    {
        $columns = array(
            0 =>'visitor_id',
            1 =>'resident_id',
            2 =>'finish',
            3 =>'statues',
        );

        $totalData = Resident_Choice_Travel::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  Resident_Choice_Travel::where('id','LIKE',"%{$search}%")
            ->WhereHas('visitor', function($q) use ($search){
                $q->where('id', '=', parent::CurrentID());
            })
            ->orWhereHas('resident', function($q) use ($search){
                $q->where('id', '=', parent::CurrentID());
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->orderBy('id','desc')
            ->get();

        if($search != null){
            $totalFiltered = Resident_Choice_Travel::where('id','LIKE',"%{$search}%")
                ->WhereHas('visitor', function($q) use ($search){
                    $q->where('id', '=', parent::CurrentID());
                })
                ->orWhereHas('resident', function($q) use ($search){
                    $q->where('id', '=', parent::CurrentID());
                })
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $f = 'No';
                $s = 'Wait Confirm by resident';
                $s1 = 'badge-danger';
                if ($post->finish == 1){
                    $f = 'Yes';
                }

                if($post->statues == 1){
                    $s = 'Wait Confirm by resident';
                    $s1 = 'badge-danger';
                }
                else if($post->statues == 2) {
                    $s = 'On Process';
                    $s1 = 'badge-warning';
                }
                else if($post->statues == 3) {
                    $s = 'Finish';
                    $s1 = 'badge-info';
                }

                    $nestedData['visitor_id'] = '<a href="'. route('profile',['email'=>$post->visitor->email,'id'=>$post->visitor->id]) .'" class="badge badge-primary">'.$post->visitor->name.'</a>';
                $nestedData['resident_id'] = '<a href="'. route('profile',['email'=>$post->resident->email,'id'=>$post->resident->id]) .'" class="badge badge-success">'.$post->resident->name.'</a>';
                $nestedData['finish'] = '<span class="badge badge-danger">'.$f.'</span>';
                $nestedData['statues'] = '<span class="badge '. $s1 .'">'.$s.'</span>';
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


}
