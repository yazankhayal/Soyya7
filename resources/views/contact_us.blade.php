@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') Contact us @endsection

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Contact Us Page</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form method="post" action="{{route('post_contact_us')}}" data-name="contact_form" class="contact_form ajaxForm">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter full name" >
                                </div>
                                <div class="form-group col-xs-6">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="abc@xyz.com" >
                                </div>
                                <div class="form-group col-xs-6 col-left-padding">
                                    <label>Subject:</label>
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" >
                                </div>
                                <div class="textarea col-xs-12">
                                    <label>Message:</label>
                                    <textarea name="comments" id="comments" class="cls_a" placeholder="Enter a message" ></textarea>
                                </div>
                                <div class="col-xs-12">
                                    <div class="comment-btn">
                                        <input type="submit" class="btn-blue btn-red"  value="Send Message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-about footer-margin">
                        <div class="about-logo">
                            <img src="{{url('/').$get_url_photo.$setting->logo}}" alt="Image">
                        </div>
                        <h4>{{$setting->name}}</h4>
                        <p>{{$setting->description}}</p>
                        <div class="contact-location">
                            <ul>
                                <li><i class="flaticon-maps-and-flags" aria-hidden="true"></i> {{$setting->location}}</li>
                                <li><i class="flaticon-phone-call"></i> {{$setting->phone}}</li>
                                <li><i class="flaticon-mail"></i> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-links">
                            <ul>
                                <li class="social-icon"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="map">
        <div id="map" style="height: 350px; width: 100%;"></div>
    </div>

@endsection

@section('js')
    <script src="{{url('/').$get_url_photo.'style_home/js/map.js'}}" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4JwWo5VPt9WyNp3Ne2uc2FMGEePHpqJ8&amp;callback=initMap" type="text/javascript"></script>
@endsection