@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') {{$item->name}} @endsection

@section('content')

    <section class="breadcrumb-outer text-center" style="background: url({{url('/').$get_url_photo.$item->avatar}})">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>{{$item->name}}</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Page</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="main-content detail pad-bottom-80">
        <div class="container">
            <div class="row">
                <div id="content" class="col-md-8">
                    <div class="detail-content content-wrapper">
                        <div class="detail-info">
                            <div class="detail-info-content clearfix">
                                <h2>{{$item->name}}</h2>
                            </div>
                        </div>
                        <div class="gallery detail-box">

                            <div id="in_th_030" class="carousel slide in_th_brdr_img_030 thumb_scroll_x swipe_x ps_easeOutQuint" data-ride="carousel" data-pause="hover" data-interval="4000" data-duration="2000">

                                <ol class="carousel-indicators">
                                    @if($gallery->count() > 0 )
                                        <?php $ccount_slider1 = 0?>
                                        @foreach($gallery as $item2)
                                            <li data-target="#in_th_030" data-slide-to="{{$ccount_slider1}}" class="active">
                                                <img style="width: 100%;height: 95px;" src="{{url('/').$get_url_photo.'tourism_companies_gallery/'.$item2->name}}" alt="in_th_030_01_sm" />
                                            </li>
                                            <?php $ccount_slider1 = $ccount_slider1 +1 ?>
                                        @endforeach
                                    @endif
                                </ol>

                                <div class="carousel-inner" role="listbox">
                                    @if($gallery->count() > 0 )
                                        <?php $ccount_slider = 0?>
                                        <?php $class_count_slider = ''?>
                                        @foreach($gallery as $item2)
                                            @if($ccount_slider == 0 )
                                                <?php $class_count_slider = 'active'?>
                                            @else
                                                <?php $class_count_slider = ''?>
                                            @endif
                                            <div class="item {{$class_count_slider}}">
                                                <img style="width: 100%;height: 400px;" src="{{url('/').$get_url_photo.'tourism_companies_gallery/'.$item2->name}}" alt="in_th_030_01" />
                                            </div>
                                            <?php $ccount_slider = $ccount_slider +1 ?>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="description detail-box">
                            <div class="detail-title">
                                <h3>Description</h3>
                            </div>
                            <div class="description-content">
                                <p>{{$item->description}}</p>
                                {!! $item->body !!}
                            </div>
                        </div>
                        <div class="location-map detail-box">
                            <div class="detail-title">
                                <h3>Location Map</h3>
                            </div>
                            <div class="map-frame">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6801.149562945955!2d{{$item->log}}9999999!3d{{$item->lat}}00000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2s!4v1567365006812!5m2!1sar!2s" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar-sticky" class="col-md-4">

                    <!-- /style_home/images/adbg.jpg-->
                    <div class="sidebar-item sidebar-helpline" style="background: url({{url('/').$get_url_photo.$item->avatar}})">
                        <div class="sidebar-helpline-content">
                            <h3>Any Questions?</h3>
                            <p style="color:#fff;margin-top: 10px;">You can communicate with us</p>
                            <p><i class="flaticon-phone-call"></i> {{$item->phone}} </p>
                            <p><i class="flaticon-mail"></i> {{$item->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
