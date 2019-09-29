@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') Resident @endsection
@section('content')


    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Resident</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Resident</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>


    <section id="our_store" class="our_store">
        <div class="container">
            <div class="row">
                @if($items->count() > 0)
                    @foreach($items as $item)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="rt-product-wrapper">
                        <div class="product-thumbnail-wrapper">
                            <div class="product-image">
                                @if($item->type_login != null)
                                    <img height="200" src="{{$item->avatar}}" alt="{{$item->name}}">
                                @else
                                    <img height="200" src="{{url('/').$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                @endif
                            </div>
                            <div class="product-label"><span class="onsale">{{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</span></div>
                        </div>
                        <div class="rt-product-meta-wrapper">
                            <h3 class="product_title">
                                <a href="{{route('profile',['email'=>$item->email,'id'=>$item->id])}}">{{$item->name}}</a>
                            </h3>
                            <div class="form-group">
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
                            <div class="rt-cartprice-wrapper">
                                <span class="price mar-bottom-20">
                                    For Free to help people
                                </span>
                                <div class="button">
                                    <a href="{{route('profile',['email'=>$item->email,'id'=>$item->id])}}" class="btn-blue btn-red">Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                @else
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <p>No data to display</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-div text-center">
                        {{ $items->render() }}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
