@extends('layouts.app')

@includeIf('layouts.css_home_render')
@section('title') Login @endsection

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2> Login Page </h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login Page</li>
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
                    <div class="form_xhs">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class=" btn-blue btn-red">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                        <!-- <hr>
                        <ul id="login_social">
                            <li>
                                <a style="background: #3B5998;border-color: transparent;" href="{{ route('facebook') }}" class="btn btn-lg btn-primary ">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a style="background: #ff0000;border-color: transparent;" href="{{ route('google') }}" class="btn btn-lg btn-primary ">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a style="background: #0077b5;border-color: transparent;" href="{{ route('linkedin') }}" class="btn btn-lg btn-primary ">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a style="background: #bd2c00;border-color: transparent;" href="{{ route('github') }}" class="btn btn-lg btn-primary ">
                                    <i class="fa fa-github"></i>
                                </a>
                            </li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
