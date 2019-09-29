<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/').$get_url_photo.$setting->logo}}">
    <title> {{$setting->name}} - @yield('title')</title>

    <script src="{{url('/').$get_url_photo.'style_home/js/head.js'}}"></script>
    <link href="{{url('/').$get_url_photo.'style_home/css/bootstrap.min.css'}}" rel="stylesheet" type="text/css">

    <link href="{{url('/').$get_url_photo.'style_home/font/flaticon.css'}}" rel="stylesheet" type="text/css">

    <link href="{{url('/').$get_url_photo.'style_home/css/plugin.css'}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{url('/').$get_url_photo.'style_home/font-awesome/font-awesome.min.css'}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{url($get_url_photo.'nprogress-master/nprogress.css')}}" />
    <style>
        .message_box{
            overflow: hidden;
            margin: 20px 0;
        }
        /* width */
        .chat_scrol::-webkit-scrollbar {
            width: 10px;
        }
        /* Track */
        .chat_scrol::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        .chat_scrol::-webkit-scrollbar-thumb {
            background: #888;
        }
        /* Handle on hover */
        .chat_scrol::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        #login_social{
            list-style: none;
            display: flex;
            justify-content : center;
            align-items: center;
            margin: 20px 0;
        }
        #login_social li{
            margin-right: 10px;
            display: inline-block;
        }
        .fa-star{
            color: #fff!important;
            text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;
        }
        .fa-star-hover{
            color: #eea236!important;
            text-shadow: -1px 0 #eea236, 0 1px #eea236, 1px 0 #eea236, 0 -1px #eea236;
        }
        .btn_load_message{
            box-shadow: 1px 1px 20px #cccccc57;
        }
        .form_xhs{
            text-align: left;
            padding: 30px;
            border: 1px solid #f1f1f1;
            box-shadow: 1px 1px 20px #cccccc57;
        }
        .p-0{
            padding: 0!important;
        }
        .p-s{
            padding: 10px 15px!important;
        }
        .form_xhs hr{
            border:1px solid #9f9f9f40;
        }
        .border-danger{
            border-color: red!important;
        }
        .chat_scrol{
            overflow-y: scroll;
            height: 500px;
        }
        .has-error{
            border-color: red;
        }
        .newslattera{
            position: absolute;
            right: 0;
            top: 0;
            padding: 10px;
            background: #d60d45;
            color: #fff;
        }
        .modal{
            z-index: 99999999999999999;
        }
        .modal .form-control{
            height: 40px;
        }
        .badge-primary{
            background-color: #007bff;
        }
        .badge-success{
            background-color: #28a745;
        }
        .badge-danger{
            background-color: #c82333;
        }
        .badge-warning{
            background-color: #e0a800;
        }
        .badge-info{
            background-color: #138496;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>
<body>

<!-- <div id="preloader">
    <div id="status"></div>
</div>-->
<div id="app">

    <audio id="plucky" class="hidden">
        <source src="plucky.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

<header>
    <div class="upper-head clearfix">
        <div class="container">
            <div class="contact-info">
                <p><i class="flaticon-phone-call"></i> Phone: {{$setting->phone}}</p>
                <p><i class="flaticon-mail"></i> Mail: <a style="color: #fff;" href="mailto:{{$setting->email}}" >{{$setting->email}}</a></p>
            </div>
            <div class="login-btn pull-right">
                @guest
                    <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a>
                    <a href="{{ route('login') }}"><i class="fa fa-unlock-alt"></i> Login</a>
                @else
                    <a href="#">Welcome : {{ Auth::user()->name }}</a>
                @endguest
            </div>
        </div>
    </div>
</header>


<div class="navigation">
    <div class="container">
        <div class="navigation-content">
            <div class="header_menu">

                <nav class="navbar navbar-default navbar-sticky-function navbar-arrow">
                    <div class="logo pull-left">
                        <a href="{{route('home_page')}}"><img alt="{{$setting->name}}" src="{{url('/').$get_url_photo.$setting->logo}}"></a>
                    </div>
                    <div id="navbar" class="navbar-nav-wrapper pull-right">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="active">
                                <a href="{{route('home_page')}}">Home </a>
                            </li>
                            <li>
                                <a href="{{route('travel')}}">Travel </a>
                            </li>
                            <li>
                                <a href="{{route('tourism_companies')}}">Tourism</a>
                            </li>
                            <li>
                                <a href="{{route('resident')}}">Resident </a>
                            </li>
                            <li>
                                <a href="{{route('blog')}}">Blog </a>
                            </li>
                            <li>
                                <a href="{{route('contact_us')}}">Contact Us</a>
                            </li>
                            @if($user != null)
                                <li>
                                    <a href="#">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge">@{{ notification_count }}</span>
                                        <i class="fa fa-angle-down"></i></a>
                                    <ul id="">
                                        <notification v-for="value,index in notification_data.message"
                                                      :key=value.index
                                                      :id=notification_data.id[index]
                                                      :image=notification_data.image[index]
                                                      :link=notification_data.link[index]
                                                      :email=notification_data.email[index]
                                                      :time=notification_data.time[index]>
                                            @{{ value }}
                                        </notification>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="badge">@{{ alerts_resident_count }}</span>
                                        <i class="fa fa-angle-down"></i></a>
                                    <ul >
                                        <alerts v-for="value,index in alerts_resident.statues"
                                                      :key=value.index
                                                      :id=alerts_resident.id[index]
                                                      :visitor_id=alerts_resident.visitor_id[index]
                                                      :resident_id=alerts_resident.resident_id[index]
                                                      :links=alerts_resident.links[index]
                                                      :finish=alerts_resident.finish[index]
                                                      :time=alerts_resident.time[index]>
                                            @{{ value }}
                                        </alerts>
                                    </ul>
                                </li>
                            @endif
                            <li>
                                <a href="#">Account <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    @guest
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @else
                                        <input value="{{$user->id}}" type="hidden" id="user_id" >
                                        <input value="{{$user->email}}" type="hidden" id="user_email" >
                                        <li class="">
                                            <a href="{{$user_dashboard_link}}" >
                                                {{$user_dashboard_name}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('my_orders')}}">
                                                My Orders
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('profile',['email'=>$user->email,'id'=>$user->id])}}">
                                                My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    @endguest
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="slicknav-mobile"></div>
                </nav>
            </div>
        </div>
    </div>
</div>

@yield('content')

<footer>
    <div class="footer-upper">
        <div class="container">
            <div class="newsletter text-center">
                <div class="section-title section-title-white text-center">
                    <h2>Newsletter Signup</h2>
                    <div class="section-icon section-icon-white">
                        <i class="flaticon-diamond"></i>
                    </div>
                    <p>Subscribe to our weekly newsletter to get updated on our latest deals</p>
                </div>
                <form class="ajaxForm newslatter" method="post" data-name="newslatter" action="{{route('newslatter')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email">
                        <button class="newslattera" type="submit">
                            <span class="search_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Sign Up</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="footer-links">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="footer-about footer-margin">
                            <div class="about-logo">
                                <img src="{{url('/').$get_url_photo.$setting->logo}}" alt="{{$setting->name}}">
                            </div>
                            <p>{{$setting->description}}</p>
                            <div class="about-location">
                                <ul>
                                    <li><i class="flaticon-maps-and-flags" aria-hidden="true"></i> {{$setting->location}}</li>
                                    <li><i class="flaticon-phone-call"></i> {{$setting->phone}}</li>
                                    <li><i class="flaticon-mail"></i> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                                </ul>
                            </div>
                            <div class="footer-social-links">
                                <ul>
                                    <li class="social-icon"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="footer-links-list footer-margin">
                            <h3>Browse Pages</h3>
                            <ul>
                                @if($pages->count() > 0)
                                    @foreach($pages as $item)
                                    <li><a href="{{route('blog_view',['slug'=>$item->slug,'id'=>$item->id])}}">
                                            {{$item->name}}
                                            <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="footer-recent-post footer-margin">
                            <h3>Recent Posts</h3>
                            <ul>
                                @if($blog_footer->count() > 0)
                                    @foreach($blog_footer as $item)
                                        <li>
                                            <div class="recent-post-item">
                                                <div class="recent-post-image">
                                                    <img src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                                </div>
                                                <div class="recent-post-content">
                                                    <h4><a href="{{route('blog_view',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></h4>
                                                    <p>{{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="footer-links-list">
                            <div class="footer-instagram">
                                <h3>Instagram</h3>
                                <ul>
                                    @if($gallery_footer->count() > 0)
                                        @foreach($gallery_footer as $item)
                                            <li><img style="width: 100%;height: 80px;" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}"></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="copyright-content">
                        <p>{{date('Y')}} <i class="fa fa-copyright" aria-hidden="true"></i> {{$setting->name}} by <a href="https://www.facebook.com/yazan.m.khayal" target="_blank">Yazan khayal</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

    <div class="modal fade" id="ModalErrors" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Center Errors</h4>
                </div>
                <div class="modal-body">
                    @includeIf('layouts.msg')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div id="back-to-top">
    <a href="#"></a>
</div>

</div>

<script src="{{ url('/').$get_url_photo.'js/app.js'}}"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/jquery-3.2.1.min.js'}}"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/bootstrap.min.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/plugin.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/main.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/main-1.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/custom-countdown.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/preloader.js'}}" type="text/javascript"></script>
<script src="{{url('/').$get_url_photo.'style_home/js/rocek.js'}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{url($get_url_photo.'nprogress-master/nprogress.js')}}"></script>
<script src="{{ url($get_url_photo.'js/master.js') }}"></script>
@if($setting->script != null)
    {!! $setting->script !!}
@endif
<script>
    $(document).ready(function () {
        @if($errors->any())
            $('#ModalErrors').modal('show');
        @endif
        @if(session()->has('error'))
            $('#ModalErrors').modal('show');
        @endif
        @if(session()->has('success'))
            $('#ModalErrors').modal('show');
        @endif
        @if(session()->has('warning'))
            $('#ModalErrors').modal('show');
        @endif
        @if(session()->has('info'))
            $('#ModalErrors').modal('show');
        @endif
    });
</script>
@yield('js')
</body>

</html>