@extends('layouts.app')

@section('title') Blogs @endsection

@includeIf('layouts.css_home_render')

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Blog List View</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Destinations</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="blog-list grid-list">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="blog-wrapper">
                        @if($items->count() > 0)
                            @foreach($items as $item)
                                <div class="blog-item grid-item">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-12">
                                            <div class="blog-image">
                                                <img src="{{$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                            <div class="blog-content">
                                                <div class="blog-date"><p><i class="fa fa-clock-o"></i> Posted On :  {{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</p></div>
                                                <h3><a href="{{route('blog_view',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></h3>
                                                <p>{{$item->description}}</p>
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
                    <div class="col-sm-12">
                        <div class="pagination-content">
                            {!! $items->appends([
                                'search' => \Illuminate\Support\Facades\Input::get('search'),
                                ]
                            )->render(); !!}
                        </div>
                    </div>
                </div>
                <div id="sidebar-sticky" class="col-md-4 col-sm-12">
                    <aside class="detail-sidebar sidebar-wrapper">
                        <div class="item-sidebar">
                            <div class="sidebar-item sidebar-item-dark">
                                <div class="detail-title">
                                    <h3>Search</h3>
                                </div>
                                <form method="get" action="{{route('blog')}}">
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <input type="text" name="search" value="{{app('request')->input('search')}}" class="form-control" id="Name" placeholder="Enter the place you want to search">
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="comment-btn">
                                                <button type="submit" class="btn-blue btn-red">Search Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="recent-post clearfix sidebar-item">
                                <div class="detail-title">
                                    <h3>Recent Posts</h3>
                                </div>
                                @if($recent2->count() > 0)
                                    @foreach($recent2 as $item)
                                        <div class="recent-item">
                                            <div class="recent-image">
                                                <img src="{{$get_url_photo.$item->avatar}}" alt="{{$item->name}}">
                                            </div>
                                            <div class="recent-content">
                                                <?php
                                                $tags  = $item->tags;
                                                $pieces = explode(",", $tags);
                                                foreach ($pieces as $key => $value) {
                                                    echo '<a href="#" class="tag tag-blue">#'.$value.'</a>';
                                                }
                                                ?>
                                                <h4><a href="{{route('blog_view',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></h4>
                                                <div class="author-detail">
                                                    <p><a href="#"><i class="fa fa-user-o"></i> {{$item->User->name}}</a></p>
                                                    <p><i class="fa fa-clock-o"></i> {{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</p>
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
