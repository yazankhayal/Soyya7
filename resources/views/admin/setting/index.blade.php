@extends('layouts.dashboard')

@section('title')
    Setting site
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                About Page
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form  method="post" enctype="multipart/form-data" id="data_form" data-name="setting" class="m-form m-form--fit m-form--label-align-right setting ajaxForm" action="{{route('setting_admin.postdata')}}">
                    <div class="m-portlet__body">
                        {{csrf_field()}}
                        <input id="id" name="id" type="hidden">
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="name" class="col-2 col-form-label">
                                        Name site
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name site">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="description" class="col-2 col-form-label">
                                        Description site
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="description" class="form-control" id="description" placeholder="Description site">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="email" class="col-2 col-form-label">
                                        Email
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="phone" class="col-2 col-form-label">
                                        Phone
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="location" class="col-2 col-form-label">
                                        Location
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label for="phone" class="col-2 col-form-label">
                                        Logo site
                                    </label>
                                    <div class="col-10">
                                        <input type="file" name="img" class="form-control" id="img">
                                        <div class="box_img d-none">
                                            <hr>
                                            <img src="" class="img-thumbnail" style="width: 100px;height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label for="location" class="col-2 col-form-label">
                                        Script site
                                    </label>
                                    <div class="col-10">
                                        <textarea style="height:130px;" cols="7" name="script" class="form-control" id="script"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <button type="submit" class="btn btn-success btn-load">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

            Render_Data();

        });

        var Render_Data = function () {
            $.ajax({
                url:"{{route('setting_admin.getdata')}}",
                method:"get",
                dataType:"json",
                success:function(result)
                {
                    if(result.data != null){
                        $('#id').val(result.data.id);
                        $('#email').val(result.data.email);
                        $('#phone').val(result.data.phone);
                        $('#description').val(result.data.description);
                        $('#name').val(result.data.name);
                        $('#location').val(result.data.location);
                        $('#script').val(result.data.script);
                        $('.box_img').removeClass('d-none');
                        $('.box_img img').attr('src',geturlphoto() + result.data.logo);
                    }
                }
            });
        };

    </script>

@endsection
