@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') {{$item->name}} @endsection
@section('content')

        <section class="breadcrumb-outer text-center" style="background: url({{url('/').$get_url_photo.$item->avatar}})">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Profile : {{$item->name}}</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="booking">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="booking-form booking-outer">
                            <div class="payment-info detail">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if($item->type_login != null)
                                            <img src="{{$item->avatar}}" class="" alt="{{$item->name}}">
                                        @else
                                            <img src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <h3>{{$item->name}}</h3>
                                        <div class="form-group">
                                            @if($star_calcau <= 5 && $star_calcau >= 4)
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                            @elseif($star_calcau <= 4 && $star_calcau >= 3)
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($star_calcau <= 3 && $star_calcau >= 2)
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($star_calcau <= 2 && $star_calcau >= 1)
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star fa-star-hover"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($star_calcau <= 1 && $star_calcau >= 0)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @endif
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="title">Email</td>
                                                <td class="b-id">
                                                    {{$item->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title">Phone</td>
                                                <td>After permission from user - then show</td>
                                            </tr>
                                            <tr>
                                                <td class="title">Contact now</td>
                                                <td>
                                                    <button style="color: #fff" class="btn btn-primary">
                                                        <i style="color: #fff" class="fa fa-envelope-open"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title">Choice this resident for your tour</td>
                                                <td>
                                                    @if(\Illuminate\Support\Facades\Auth::user() != null)
                                                        @if($resident_choice_travel != null)
                                                            @if($resident_choice_travel->finish == 0)
                                                                @if($resident_choice_travel->statues == 1)
                                                                    <div class="alert alert-warning">
                                                                        <p>
                                                                            Awaiting approval from
                                                                            <strong>
                                                                                {{$resident_choice_travel->resident->name}}
                                                                            </strong>
                                                                        </p>
                                                                    </div>
                                                                    @if($resident_choice_travel->resident->id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                            <button data-id="{{$resident_choice_travel->id}}" id="btn_ok_choice" type="button" class="btn btn-success">Ok</button>
                                                                            <button data-id="{{$resident_choice_travel->id}}" id="btn_cancel_choice" type="button" class="btn btn-danger">Cancel</button>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="alert alert-warning">
                                                                        <p>
                                                                            On Process
                                                                        </p>
                                                                    </div>
                                                                    @if($resident_choice_travel->visitor_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                        <button data-id="{{$resident_choice_travel->id}}" id="btn_finish_choice" class="btn btn-primary">
                                                                            <i style="color: #Fff;" class="fa fa-close"></i>
                                                                            Finish
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            <button data-toggle="modal" data-target="#Mod_Choice_your_travel" id="btn_choice_for_your_tour" style="color: #fff" class="btn btn-warning">
                                                                <i style="color: #fff" class="fa fa-check"></i>
                                                                Continue
                                                            </button>
                                                        @endif
                                                    @else
                                                        <div class="alert alert-warning">
                                                            <p>Please login or register to choices</p>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if($user != null)
                                                @if($item->id == $user->id)
                                                    <tr>
                                                        <td class="title">Edit profile</td>
                                                        <td>
                                                            <button data-toggle="modal" data-target="#my_edit_modeal" style="color: #fff" class="btn btn-success">
                                                                <i style="color: #fff" class="fa fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @guest
                                <div class="row">
                                    <div class="col col-md-12">
                                        <div class="alert alert-warning">
                                            <p>Please login or register to chatting</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if($item->id != $user->id)
                                    <div class="row">
                                        <div class="list-group">
                                            <input value="{{$item->id}}" type="hidden" id="txt_resident" >
                                            <input value="{{$user->role}}" type="hidden" id="user_role" >
                                            <ul>
                                                <li style="overflow: hidden;">
                                                    <div class="list-group-item active" style="overflow: hidden;">
                                                               <span class="pull-left">
                                                                    Chatting here with <strong>{{$item->name}}</strong>
                                                               </span>
                                                        <span class="pull-right btn-default btn-sm  btn box_chatting">
                                                                    <i class="fa fa-close"></i>
                                                                </span>
                                                        <span class="btn pull-right btn-default btn-sm btn_load_message" @click="load_more">
                                                                    <i class="fa fa-repeat"></i> Load more
                                                                </span>
                                                    </div>
                                                </li>
                                                <ul class="list-group" v-if="msg.view">
                                                    <li class="list-group-item alert " v-bind:class="msg.type" >
                                                        <span>@{{ msg.error }}</span>
                                                    </li>
                                                </ul>
                                                <!--  v-chat-scroll-->
                                                <div class="chat_scrol box_chatting_body">
                                                    <input placeholder="write message...."  v-model="message"  class="form-control" @keyup.enter='send'>
                                                    <div class="badge badge-primary">@{{typing}}</div>
                                                    <message v-for="value,index in chat.message"
                                                             :key=value.index
                                                             :color=chat.color[index]
                                                             :user=chat.user[index]
                                                             :time=chat.time[index]
                                                             :avatar=chat.avatar[index]
                                                    >
                                                        @{{ value }}
                                                    </message>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <p>My profile dont allow to access chatting</p>
                                    </div>
                                @endif
                            @endguest

                            @if($stars->count() > 0)
                                <h5>Rating</h5>
                                <hr>
                                <div class="row">
                                    @foreach($stars as $star)
                                        <div class="col-xs-6 col-md-3 text-center" style="height: 300px;">
                                            <a href="{{route('profile',['email'=>$star->visitor->email,'id'=>$star->visitor->id])}}" class="thumbnail">
                                                <img style="border-radius: 100%;width: 60px;height: 60px;text-align: center;" src="{{url('/').$get_url_photo.$star->visitor->avatar}}" class="" alt="{{$star->visitor->name}}">
                                                <div class="caption">
                                                    <div class="form-group">
                                                        @if($star->star <= 5 && $star->star >= 4)
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                        @elseif($star->star <= 4 && $star->star >= 3)
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star"></i>
                                                        @elseif($star->star <= 3 && $star->star >= 2)
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star "></i>
                                                            <i class="fa fa-star"></i>
                                                        @elseif($star->star <= 2 && $star->star >= 1)
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star fa-star-hover"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @elseif($star->star <= 1 && $star->star >= 0)
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    </div>
                                                    <h5> Visitor : {{$star->visitor->name}}</h5>
                                                    <p>Comment : {{$star->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <div class="pagination-content">
                                            {{$stars->render()}}
                                        </div>
                                    </div>
                                </div>
                              @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert-danger alert">
                                            <p>No Found rating to display</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div id="sidebar-sticky" class="col-md-4">
                        <aside class="detail-sidebar sidebar-wrapper">
                            <div class="sidebar-item sidebar-helpline">
                                <div class="sidebar-helpline-content">
                                    <h3>Any Questions?</h3>
                                    <p>Lorem ipsum dolor sit amet, consectet ur adipiscing elit, sedpr do eiusmod tempor incididunt ut.</p>
                                    <p><i class="flaticon-phone-call"></i>  After per
                                        mission from user - then show
                                    </p>
                                    <p><i class="flaticon-mail"></i> <a style="color: #Fff;" href="mailto:{{$item->email}}" class="__cf_email__">{{$item->email}}</a></p>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
    </section>

    @if($user != null)
        @if($item->id == $user->id)
            <div class="modal fade" id="my_edit_modeal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit : {{$user->email}}</h4>
                        </div>
                        <form class="ajaxForm update_info" method="post" action="{{route('update_info')}}" data-name="update_info">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"  value="{{$user->name}}" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="cls form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter password confirmation">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class=" control-label">Phone</label>
                                    <div class="">
                                        <input id="phone" value="{{$user->phone}}" type="text" class="form-control" name="phone" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="cls form-control" name="avatar" id="avatar">
                                    <br>
                                    @if($item->type_login != null)
                                        <img style="width: 200px;height: 200px;" src="{{$item->avatar}}" class="" alt="{{$item->name}}">
                                    @else
                                        <img style="width: 200px;height: 200px;" src="{{url('/').$get_url_photo.$user->avatar}}" class="img-thumbnail" >
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="countries_id" class="control-label">Choice the countries</label>
                                    <div class="">
                                        <select class="cls form-control" name="countries_id" id="countries_id">
                                            <option value="">Choice the countries</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label">Choice the role</label>
                                    <div class="">
                                        <label>
                                            <input type="radio" id name="role" value="Resident" {{$item->role == 2 ? 'checked' : ''}}>
                                            Resident
                                        </label>
                                        <label>
                                            <input type="radio" name="role" value="Visitor" {{$item->role == 3 ? 'checked' : ''}}>
                                            Visitor
                                        </label>
                                        <span id="role"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if($item->role == 2)
        <div class="modal fade" id="Mod_Choice_your_travel" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-warning">Continue process</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-warning">
                            are sure of the continue process
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn_continue btn btn-warning">Yes,sure</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="Mod_Star_Choice_your_travel" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-warning">Continue process</h4>
                    </div>
                    <form method="POST" class="ajaxForm Star_Choice_your_travel" data-name="Star_Choice_your_travel" action="{{route('Star_Choice_your_travel')}}">
                        {{csrf_field()}}
                        <input id="id_star_resident_id" name="id_star_resident_id" type="hidden">
                        <input value="{{url()->current()}}" id="current" type="hidden" name="current">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-12">Choose your rating for the evaluator</label>
                                <div class="box-q1 rating col-md-12">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <input type="hidden" name="star_value" class="star_value form-control"  id="star_value">
                            </div>
                            <div class="form-group ">
                                <label class="">Comment</label>
                                <input type="text" name="name" placeholder="Comment" class="name form-control"  id="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Yes,sure</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endif

@endsection
@section('js')

    <script type="text/javascript">

        $(document).ready(function() {

            Countries();

            $('.box_chatting').click(function () {
                if($('.box_chatting i').hasClass('fa-expand')){
                    $('.box_chatting_body').fadeIn();
                    $('.box_chatting i').addClass('fa-close');
                    $('.box_chatting i').removeClass('fa-expand');
                }
                else if($('.box_chatting i').hasClass('fa-close')){
                    $('.box_chatting_body').fadeOut();
                    $('.box_chatting i').removeClass('fa-close');
                    $('.box_chatting i').addClass('fa-expand');
                }
            });

            $('#btn_countries_search').click(function () {
                var v = $('#countries_search').val();
                Countries(v);
            });

            $('#btn_countries').change(function () {
                var v = $(this).val();
                Countries(v);
            });

            $('#btn_ok_choice').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    url:"{{ route('btn_ok_cancel_choice') }}",
                    method:"POST",
                    dataType:"json",
                    data :{
                        _token: "{{csrf_token()}}",
                        id : id,
                        type : "ok",
                        url : "{{url()->current()}}",
                    },
                    success:function(result)
                    {
                        if(result.url != null){
                            window.setTimeout(function(){
                                window.location.href = result.url;
                            }, 2000);
                        }
                        toastr.success(result.success, "{{$item->name}}");
                    }
                });
            });

            $('#btn_cancel_choice').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    url:"{{ route('btn_ok_cancel_choice') }}",
                    method:"POST",
                    dataType:"json",
                    data :{
                        _token: "{{csrf_token()}}",
                        id : id,
                        type : "cancel",
                        url : "{{url()->current()}}",
                    },
                    success:function(result)
                    {
                        if(result.url != null){
                            window.setTimeout(function(){
                                window.location.href = result.url;
                            }, 2000);
                        }
                        toastr.error(result.error, "{{$item->name}}");
                    }
                });
            });

            $('#btn_finish_choice').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    url:"{{ route('btn_ok_cancel_choice') }}",
                    method:"POST",
                    dataType:"json",
                    data :{
                        _token: "{{csrf_token()}}",
                        id : id,
                        type : "finish",
                        url : "{{url()->current()}}",
                    },
                    success:function(result)
                    {
                        toastr.success(result.success, "{{$item->name}}");

                        Question();

                        $('.fa').click(function () {
                            Question();
                        });

                        $('.rating').click(function () {
                            Question();
                        });

                        $(".fa-star").click(function () {
                            $(this).removeClass("fa-star-hover").siblings().removeClass("fa-star-hover");
                            $(this).addClass("fa-star-hover").prevAll().addClass("fa-star-hover");
                        });

                        $('#Mod_Star_Choice_your_travel').modal('show');
                        $('#id_star_resident_id').val("{{$item->id}}");

                    }
                });
            });

            $('.btn_continue').click(function () {
                $.ajax({
                    url:"{{ route('continue_choice_your_travel') }}",
                    method:"POST",
                    dataType:"json",
                    data :{
                        _token: "{{csrf_token()}}",
                        resident_id : "{{$item->id}}"
                    },
                    success:function(result)
                    {
                        if (result.success){
                            $('.modal').hide();
                            toastr.success(result.success, "{{$item->name}}");
                        }
                        else{
                            $.each(result.errors ,function (index,val) {
                                toastr.error(val, "{{$item->name}}");
                            });
                        }
                    }
                });
            });

        });

        var Countries = function (search) {
            $.ajax({
                url:"{{ route('countries') }}" ,
                method:"get",
                data:{
                    search : search,
                },
                dataType:"json",
                success:function(result)
                {
                    $('#countries_id').html();
                    if(result.success.length){
                        for (var i = 0; i < result.success.length ; i++){
                            var selected = "{{$item->countries_id}}";
                            var selected_ch = "";
                            if(selected == result.success[i].id){
                                selected_ch = "selected";
                            }
                            $('#countries_id').append('<option value="'+ result.success[i].id +'" '+ selected_ch +'>'+ result.success[i].name +'</option>');
                        }
                    }
                }
            });
        };

        var Question = function () {
            var q1 = $(".box-q1 .fa-star-hover").length;
            $('#star_value').val(q1);
        };

    </script>
@endsection
