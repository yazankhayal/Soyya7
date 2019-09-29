@extends('layouts.app')

@section('title') {{$item->name}} @endsection

@includeIf('layouts.css_home_render')

@section('content')

    <section class="breadcrumb-outer text-center" style="background: url({{url('/').$get_url_photo.$item->avatar}})">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>{{$item->name}}</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Planning for ...</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>


    <section class="item-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="item-wrapper">
                        <div class="cover-content">
                            <div class="author-detail">
                                <?php
                                    $tags  = $item->tags;
                                    $pieces = explode(",", $tags);
                                    foreach ($pieces as $key => $value) {
                                        echo '<a href="#" class="tag tag-blue">#'. $value .'</a>';
                                    }
                                ?>
                                <a href="#" class="tag tag-blue"><i class="fa fa-eye"></i> {{$item->Eye_Count->count()}}</a>
                            </div>
                            <h2>{{$item->name}}</h2>
                            <div class="author-detail">
                                <span><a href="#"><i class="fa fa-clock-o"></i> Posted On :  {{date('d',strtotime($item->created_at))}} {{date('M',strtotime($item->created_at))}} {{date('Y',strtotime($item->created_at))}}</a></span>
                                <span class="blog-date-icon">
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> {{$item->Eye_Count->count()}}</a>
                                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> {{$item->Like_Count->count()}}</a>
                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> {{$comment->count()}}</a>
                                </span>
                            </div>
                        </div>
                        <div class="cover-image">
                            <img src="{{url($get_url_photo.$item->avatar)}}" alt="{{$item->name}}">
                        </div>
                        <div class="item-detail">
                            <p class="articlepara">
                                {{$item->description}}
                            </p>
                            <div style="overflow: hidden">
                                {!! $item->body !!}
                            </div>
                        </div>

                        <div class="author-profile">
                            <div class="profile-image">
                                <img src="{{url($get_url_photo.$item->User->avatar)}}" alt="{{$item->User->name}}">
                            </div>
                            <div class="profile-content">
                                <h3>{{$item->User->name}}</h3>
                                <ul class="profile-link">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                                </ul>
                                <p>{{$item->User->email}}</p>
                            </div>
                        </div>
                        <div class="share-buttons">
                            <a href="#" class="btn-large btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Share on Facebook</a>
                            <p>
                                <button class="btn btn-danger" id="btn_like">
                                    <i class="fa fa-heart" ></i> {{$item->Like_Count->count()}}
                                </button>
                            </p>
                            <a href="#" class="btn-large btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Share on Twitter</a>
                        </div>
                        <div class="item-tags">
                            <?php
                            $tags  = $item->tags;
                            $pieces = explode(",", $tags);
                            foreach ($pieces as $key => $value) {
                                echo '<a href="#" class="tag tag-blue">#'. $value .'</a>';
                            }
                            ?>
                        </div>
                        <div class="related-posts">
                            <div class="row">
                                @if($recent->count() > 0)
                                     @foreach($recent as $item3)
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="blog-item">
                                                <div class="blog-image">
                                                    <img height="300" src="{{url($get_url_photo.$item3->avatar)}}" alt="{{$item3->name}}">
                                                </div>
                                                <div class="blog-content">
                                                    <div class="blog-date"><p><i class="fa fa-clock-o"></i> Posted On : {{$item3->created_at}}</p></div>
                                                    <h3><a href="{{route('blog_view',['slug'=>$item3->slug,'id'=>$item3->id])}}">{{$item3->name}}</a></h3>
                                                    <p>
                                                        {{$item3->description}}
                                                    </p>
                                                    <div class="blog-author">
                                                        <div class="pull-left">
                                                            <p><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i>
                                                                {{$item3->User->name}}
                                                                </a></p>
                                                        </div>
                                                        <div class="pull-right blog-date-icon">
                                                            <p><i class="fa fa-eye" aria-hidden="true"></i> {{$item3->Eye_Count->count()}}</p>
                                                            <p><i class="fa fa-heart" aria-hidden="true"></i> {{$item3->Like_Count->count()}}</p>
                                                            <p><i class="fa fa-comment-o" aria-hidden="true"></i> {{$item3->Comment_Count->count()}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="comment-box">
                            <h3>Comments : {{$comment->count()}}</h3>
                            @if($comment->count() > 0)
                                <ul class="comment-list">
                                    @foreach($comment as $commentitem)
                                    <li>
                                        <div class="comment-item">
                                            <div class="comment-image">
                                                <img src="{{url('/').$get_url_photo.$commentitem->User->avatar}}" alt="{{$commentitem->User->name}}">
                                            </div>
                                            <div class="comment-content">
                                                <h4>{{$commentitem->User->name}}</h4>
                                                <p class="date"><i class="fa fa-clock-o"></i> {{$commentitem->created_at}}</p>
                                                <p>
                                                    {{$commentitem->name}}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        @guest
                                <div class="comment-form">
                                    <div class="alert alert-warning">
                                        <p>Please login or register to commenting</p>
                                    </div>
                                </div>
                                @else
                                    <div class="comment-form">
                                        <form class="ajaxForm  comment" data-name="comment" method="POST" action="{{route('comment_post')}}">
                                            {{csrf_field()}}
                                            <input value="{{url()->current()}}" id="current" type="hidden" name="current">
                                            <input value="{{$item->id}}" id="post_id" type="hidden" name="post_id">
                                            <h3>Add a comment</h3>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="Name">Your Comment:</label>
                                                    <textarea class="" id="name" name="name"></textarea>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="comment-btn">
                                                        <button type="submit" class="btn-blue btn-red">Submit Comment</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                         @endguest
                    </div>
                </div>
                <div id="sidebar-sticky" class="col-md-4 col-sm-12">
                    <aside class="detail-sidebar sidebar-wrapper">
                        <div class="item-sidebar">
                            <div class="sidebar-item sidebar-item-dark">
                                <div class="detail-title">
                                    <h3>Search</h3>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <input type="text" class="form-control" id="search1" placeholder="Enter the place you want to search">
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="comment-btn">
                                                <a href="#" class="btn-blue btn-red">Search Now</a>
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
                                    @foreach($recent2 as $item2)
                                        <div class="recent-item">
                                            <div class="recent-image">
                                                <img height="80" src="{{url($get_url_photo.$item2->avatar)}}" alt="{{$item2->name}}">
                                            </div>
                                            <div class="recent-content">
                                                <h4><a href="{{route('blog_view',['slug'=>$item2->slug,'id'=>$item2->id])}}">{{$item2->name}}</a></h4>
                                                <div class="author-detail">
                                                    <p><a href="{{route('blog_view',['slug'=>$item2->slug,'id'=>$item2->id])}}"><i class="fa fa-user-o"></i> {{$item2->User->name}}</a></p>
                                                    <p><i class="fa fa-clock-o"></i>{{$item2->created_at}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="ad1 sidebar-item">
                                <div class="detail-title">
                                    <h3>Popular Tags</h3>
                                </div>
                                <div class="popular-tag-content">
                                    <ul>
                                        <?php
                                        $tags  = $item->tags;
                                        $pieces = explode(",", $tags);
                                        foreach ($pieces as $key => $value) {
                                            echo '<li><a href="#" class="">#'. $value .'</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

            $('#btn_like').click(function () {
                $.ajax({
                    url:"{{route('like_post')}}",
                    method:"get",
                    data:{
                      id : "{{$item->id}}",
                      slug : "{{$item->slug}}",
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if (result.success){
                            $('#btn_like i').removeClass('fa fa-heart-o');
                            $('#btn_like i').addClass('fa fa-heart');
                            toastr.success(result.success, "{{$item->name}}");
                        }
                        else{
                            toastr.error(result.error, "{{$item->name}}");
                        }
                    }
                });
            });

        });

    </script>

@endsection
