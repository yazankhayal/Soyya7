@extends('layouts.app')

@section('title') Travel @endsection

@section('css')
    <link href="{{url('/').$get_url_photo.'style_home/css/hotel.css'}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{url('/').$get_url_photo.'style_home/js/rangeslider.js'}}" type="text/javascript" ></script>
@endsection

@section('content')


    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Travel</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Travel</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="popular-packages pad-bottom-80">
        <div class="container">
            <div class="section-title">
                <h2>Popular <span>Travel</span></h2>
                <p>All travel countries .</p>
            </div>
            <div class="row">
                @if($items->count() > 0)
                    @foreach($items as $item)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="package-item">
                                <img style="height: 300px;" src="{{$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                <div class="package-content">
                                    <h5>Starting: <span>Free from</span> / People </h5>
                                    <h3><a href="{{route('travel_view',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></h3>
                                    <p>{{$item->description}}</p>
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
                <div class="col-xs-12">
                    <div class="pagination-content">
                        {{$items->render()}}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
