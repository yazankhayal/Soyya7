@extends('layouts.app')

@section('title') Home page @endsection

@includeIf('layouts.css_home_render')

@section('content')

    <section id="home_banner">

        <div id="kenburns_061" class="carousel slide ps_indicators_txt_icon ps_control_txt_icon kbrns_zoomInOut thumb_scroll_x swipe_x ps_easeOutQuart" data-ride="carousel" data-pause="hover" data-interval="10000" data-duration="2000">

            <div class="carousel-inner" role="listbox">
                @if($slider->count() > 0)
                    <?php $ccount_slider = 0?>
                    <?php $class_count_slider = ''?>
                    @foreach($slider as $item)
                            @if($ccount_slider == 0 )
                                <?php $class_count_slider = 'active'?>
                            @else
                                <?php $class_count_slider = ''?>
                            @endif
                        <div class="item {{$class_count_slider}}">
                            <img style="width: 100%;height: 450px;" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}" />
                            <div class="kenburns_061_slide" data-animation="animated fadeInRight">
                                <h2>{{$item->description}}</h2>
                                <h1>{{$item->name}}</h1>
                                <a href="{{route('travel_view',['slug'=>$item->slug,'id'=>$item->id])}}" class="btn-blue btn-red">View Our Tour</a>
                            </div>
                        </div>
                                <?php $ccount_slider = $ccount_slider +1 ?>
                    @endforeach
                @endif
            </div>

            <a class="left carousel-control" href="#kenburns_061" role="button" data-slide="prev">
                <span>prev</span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="right carousel-control" href="#kenburns_061" role="button" data-slide="next">
                <span>next</span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>



    <section class="popular-packages" style="margin-top: 60px;">
        <div class="container">
            <div class="section-title text-center">
                <h2>Popular Packages</h2>
                <div class="section-icon">
                    <i class="flaticon-diamond"></i>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Duis aute irure dolor in reprehenderit..</p>
            </div>
            <div class="row package-slider slider-button">
                @if($slider->count() > 0)
                    @foreach($slider as $item)
                        <div class="col-sm-4">
                                <div class="package-item">
                                    <div class="package-image">
                                        <img style="height: 300px;" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                        <div class="package-price">
                                            <div class="deal-rating">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                            </div>
                                            <p><span>Free For</span> / People </p>
                                        </div>
                                    </div>
                                    <div class="package-content">
                                        <h3>{{$item->name}}</h3>
                                        <p class="package-days"><i class="flaticon-time"></i> {{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</p>
                                        <p>{{$item->description}}</p>
                                        <div class="package-info">
                                            <a href="{{route('travel_view',['slug'=>$item->slug,'id'=>$item->id])}}" class="btn-blue btn-red">View more details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section class="trip-ad">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="trip-ad-content">
                        <div class="ad-title">
                            <h2>Explore The <span>Thailand Trip</span></h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismody tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim adi minim veniam, qu nostrud exerci tation dolore magna aliquam erat volutpat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismody tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim adi minim veniam, qu nostrud exerci tation dolore magna aliquam erat volutpat.</p>
                        <div class="trip-ad-btn">
                            <a href="{{route('travel')}}" class="btn-blue btn-red"> for helping people</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="ad-price">
                        <div class="ad-price-inner">
                            <span>Starting at <span class="rate">Free</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials" style="background: #fbfbfb">
        <div class="section-title text-center">
            <h2>Best Rated Resident</h2>
            <div class="section-icon section-icon-white">
                <i class="flaticon-diamond"></i>
            </div>
        </div>

        <div id="testimonial_094" class="carousel slide testimonial_094_indicators thumb_scroll_x swipe_x ps_easeOutSine" data-ride="carousel" data-pause="hover" data-interval="3000" data-duration="1000">

            <ol class="carousel-indicators">
                @if($Resident->count() > 0)
                    <?php $ccount_slider = 0?>
                    <?php $class_count_slider = ''?>
                    @foreach($Resident as $item)
                        @if($ccount_slider == 0 )
                            <?php $class_count_slider = 'active'?>
                        @else
                            <?php $class_count_slider = ''?>
                        @endif
                            <li data-target="#testimonial_094" data-slide-to="{{$ccount_slider}}" class="{{$class_count_slider}}">

                                @if($item->type_login != null)
                                    <img style="height: 100%;" src="{{$item->avatar}}" alt="{{$item->name}}">
                                @else
                                    <img style="height: 100%;" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                @endif
                            </li>
                        <?php $ccount_slider = $ccount_slider +1 ?>
                    @endforeach
                @endif
            </ol>

            <div class="carousel-inner" role="listbox">

                @if($Resident->count() > 0)
                    <?php $ccount_slider = 0?>
                    <?php $class_count_slider = ''?>
                    @foreach($Resident as $item)
                        @if($ccount_slider == 0 )
                            <?php $class_count_slider = 'active'?>
                        @else
                            <?php $class_count_slider = ''?>
                        @endif
                        <div class="item {{$class_count_slider}}">
                                <div class="testimonial_094_slide">
                                    <p>
                                        {{$item->Countries->name}}
                                    </p>
                                    <div class="deal-rating">
                                        @if($item->Stars($item->id) <= 5 && $item->Stars($item->id) >= 4)
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                        @elseif($item->Stars($item->id) <= 4 && $item->Stars($item->id) >= 3)
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->Stars($item->id) <= 3 && $item->Stars($item->id) >= 2)
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star "></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->Stars($item->id) <= 2 && $item->Stars($item->id) >= 1)
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star fa-star-hover"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @elseif($item->Stars($item->id) <= 1 && $item->Stars($item->id) >= 0)
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
                                    <h5><a href="{{route('profile',['email'=>$item->email,'id'=>$item->id])}}">{{$item->name}}</a></h5>
                                </div>
                            </div>
                        <?php $ccount_slider = $ccount_slider +1 ?>
                    @endforeach
                @endif

            </div>
        </div>
    </section>


    <section class="countdown-section">
        <div class="container">
            <div class="countdown-title">
                <h2>Special Tour in May, Discover <span>Thailand</span> for 50 Customers with <span>Discount 30%</span></h2>
                <p>It’s limited seating! Hurry up</p>
            </div>
            <div class="countdown countdown-container container">
                <p id="demo"></p>
            </div>
        </div>
        <div class="testimonial-overlay"></div>
    </section>


    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Our Blog</h2>
                        <div class="section-icon">
                            <i class="flaticon-diamond"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Duis aute irure dolor in reprehenderit..</p>
                    </div>
                </div>
                @if($blog->count() > 0)
                    @foreach($blog as $item)
                        <div class="col-md-4 col-sm-12">
                                <div class="blog-item">
                                    <div class="blog-image">
                                        <img style="height: 250px;" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-date"><p><i class="fa fa-clock-o"></i> Posted On : {{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</p></div>
                                        <h3><a href="{{route('blog_view',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></h3>
                                        <p>
                                            {{$item->description}}
                                        </p>
                                        <div class="blog-author">
                                            <div class="pull-left">
                                                <p><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> {{$item->User->name}}</a></p>
                                            </div>
                                            <div class="pull-right blog-date-icon">
                                                <p><i class="fa fa-eye" aria-hidden="true"></i> {{$item->Eye_Count->count()}}</p>
                                                <p><i class="fa fa-heart" aria-hidden="true"></i> {{$item->Like_Count->count()}}</p>
                                                <p><i class="fa fa-comment-o" aria-hidden="true"></i> {{$item->Comment_Count->count()}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section class="trusted-partners">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-4">
                    <div class="partners-title">
                        <h3>Our <span>Partners</span></h3>
                    </div>
                </div>
                <div class="col-md-9 col-xs-8">
                    <ul class="partners-logo partners-slider">
                        @if($partner->count() > 0)
                            @foreach($partner as $item)
                                <li><a href="{{$item->link}}"><img src="{{$get_url_photo.$item->avatar}}" alt="{{$item->name}}"></a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
