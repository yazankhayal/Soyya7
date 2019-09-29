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
                                <div class="deal-rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star-o"></span>
                                    <span class="fa fa-star-o"></span>
                                </div>
                            </div>
                        </div>
                        <div class="gallery detail-box">

                            <div id="in_th_030" class="carousel slide in_th_brdr_img_030 thumb_scroll_x swipe_x ps_easeOutQuint" data-ride="carousel" data-pause="hover" data-interval="4000" data-duration="2000">

                                <ol class="carousel-indicators">
                                    @if($item->Gallery_Travel->count() > 0 )
                                        <?php $ccount_slider1 = 0?>
                                        @foreach($item->Gallery_Travel as $item2)
                                            <li data-target="#in_th_030" data-slide-to="{{$ccount_slider1}}" class="active">
                                                <img style="width: 100%;height: 95px;" src="{{url('/').$get_url_photo.'travel_gallery/'.$item2->name}}" alt="in_th_030_01_sm" />
                                            </li>
                                            <?php $ccount_slider1 = $ccount_slider1 +1 ?>
                                        @endforeach
                                    @endif
                                </ol>

                                <div class="carousel-inner" role="listbox">
                                    @if($item->Gallery_Travel->count() > 0 )
                                        <?php $ccount_slider = 0?>
                                        <?php $class_count_slider = ''?>
                                        @foreach($item->Gallery_Travel as $item2)
                                            @if($ccount_slider == 0 )
                                                <?php $class_count_slider = 'active'?>
                                            @else
                                                <?php $class_count_slider = ''?>
                                            @endif
                                            <div class="item {{$class_count_slider}}">
                                               <img style="width: 100%;height: 400px;" src="{{url('/').$get_url_photo.'travel_gallery/'.$item2->name}}" alt="in_th_030_01" />
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
                        <div class="comments detail-box">
                            <div class="detail-title">
                                <h3>Resident</h3>
                            </div>
                            <div class="comment-content">
                                <div class="comment-items">
                                    <div class="row">
                                        @if($users->count() > 0)
                                            @foreach($users as $item)
                                                <div class="col-sm-3 col-md-3">
                                                    <div class="thumbnail text-center">
                                                        <img style="width: 50px;height: 50px;" src="{{url(''.$get_url_photo.$item->avatar)}}" class="img-circle mr-3" alt="{{$item->name}}">
                                                        <div class="caption">
                                                            <h3>{{$item->name}}</h3>
                                                            <p>{{$item->email}}</p>
                                                            <p>
                                                                <a href="{{route('profile',['email'=>$item->email,'id'=>$item->id])}}" class="btn btn-primary" role="button">
                                                                    Contact with him
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col col-md-12">
                                                <div class="alert alert-warning">
                                                    <p>No found any resident for this travel</p>
                                                </div>
                                            </div>
                                        @endif
                                            <div class="col-sm-12">
                                                <div class="pagination-content">
                                                    {{$users->render()}}
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar-sticky" class="col-md-4">
                    <aside class="detail-sidebar sidebar-wrapper">
                        <div class="sidebar-item sidebar-item-dark">
                            <div class="detail-title">
                                <h3>Would you like to come to this city?</h3>
                                <p style="color:#fff;margin-top: 10px;">Then choose from the residents to reach with him</p>
                            </div>


                            <div class="row">
                                @if($users->count() > 0)
                                    @foreach($users as $item)
                                        <div class="col col-md-3">
                                            <div class="media">
                                                <img style="width: 50px;height: 50px;" src="{{url(''.$get_url_photo.$item->avatar)}}" class="img-circle mr-3" alt="{{$item->name}}">
                                                <div class="media-body">
                                                    <a style="color: #fff;" href="{{route('profile',['email'=>$item->email,'id'=>$item->id])}}" class="mt-0">{{$item->name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
