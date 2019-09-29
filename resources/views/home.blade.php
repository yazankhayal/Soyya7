@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') Control Panel @endsection

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2> Control Panel Page </h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Control Panel Page</li>
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
                    <div class="login-form ">
                        <div class="form_xhs text-center">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
