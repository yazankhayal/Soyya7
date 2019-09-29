@extends('layouts.app')

@includeIf('layouts.css_home_render')
@section('title') Register @endsection

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2> Register Page </h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register Page</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-offset-3">
                    <div class="login-form">
                        <form class="form-horizontal ajaxForm post_new_user" data-name="post_new_user" method="POST" action="{{ route('post_new_user') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" >

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" >

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4  control-label">Choice the countries</label>
                                <div class="col-md-6">
                                    <!--<div class="input-group">
                                     <input class="form-control" name="countries_search" id="countries_search">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" id="btn_countries_search" type="button">
                                             <i class="fa fa-search"></i>
                                        </button>
                                      </span>
                                    </div>-->
                                    <select class="cls form-control" name="countries_id" id="countries_id">
                                        <option value="">Choice the countries</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4  control-label">Choice the role</label>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" id name="role" value="Resident">
                                        Resident
                                    </label>
                                    <label>
                                        <input type="radio" name="role" value="Visitor">
                                        Visitor
                                    </label>
                                    <span id="role"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class=" btn-load btn-blue btn-red">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function() {

            Countries();

            $('#btn_countries_search').click(function () {
                var v = $('#countries_search').val();
                Countries(v);
            });

            $('#btn_countries').change(function () {
                var v = $(this).val();
                Countries(v);
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
                            $('#countries_id').append('<option value="'+ result.success[i].id +'">'+ result.success[i].name +'</option>');
                        }
                    }
                }
            });
        };

    </script>
@endsection
