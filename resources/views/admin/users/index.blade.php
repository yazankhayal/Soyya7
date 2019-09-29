@extends('layouts.dashboard')

@section('title')
    Users
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Users
                        <small>
                            initialized
                        </small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <button type="button" class="btncreate btn btn-primary">
                            Create new
                        </button>
                    </div>
                </div>
            </div>
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <table class="table data_Table table-bordered" id="data_Table">
                    <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Confirm Email</th>
                    <th>Avatar</th>
                    <th>Role</th>
                    <th>Options</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="ajaxForm users" enctype="multipart/form-data" data-name="users" action="{{route('users.postdata')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h5 class="modal-title title">Create new</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="id" name="id" class="cls" type="hidden">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="cls form-control" name="name" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="cls form-control" name="email" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="cls form-control" name="phone" id="phone" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="cls form-control" name="role" id="role">
                                <option value="">Role select</option>
                                <option value="1">Admin</option>
                                <option value="2">Resident</option>
                                <option value="3">Visitor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="cls form-control" name="avatar" id="avatar">
                            <br>
                            <img style="width: 200px;height: 200px;" class="avatar_view d-none img-thumbnail" >
                        </div>
                        <div class="form-group">
                            <label for="phone">Choice the countries</label>
                            <div class="input-group mb-3">
                                <input class="form-control" name="countries_search" id="countries_search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="btn_countries_search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <select class="cls form-control" name="countries_id" id="countries_id">
                                <option value="">Choice the countries</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="cls form-control" name="password" id="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="cls form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter password confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-load">Save changes</button>
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
            Countries();
            var name_form = $('.ajaxForm').data('name');

            $.fn.dataTable.ext.errMode = 'none';
            $('#data_Table').on( 'error.dt', function ( e, settings, techNote, message ) {
                console.log( 'An error has been reported by DataTables: ', message );
            } ) .DataTable();
            $('#data_Table').DataTable();

            $('.btncreate').click(function(){
                $("#Modal").modal({ show: true, backdrop: "static" });
                $('.modal .title').html('Add new one');
                $('#button_action').val('insert');
                $('.cls').val('');
                $('.'+name_form+' .error').remove();
                $('.'+name_form+' .form-control').removeClass('border-danger');
                $('.avatar_view').addClass('d-none');
            });

            $(document).on('click', '.btn_edit_current', function () {
                var id = $(this).data("id");
                $('#Modal').modal('show');
                $('.modal .title').html('Edit current');
                $('#form_output').html('');
                $('#button_action').val('edit');
                $('#action').val('Edit now');
                $('.'+name_form+' .error').remove();
                $('.'+name_form+' .form-control').removeClass('border-danger');

                if(id){
                    $('#data_Table tbody tr').css('background','transparent');
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }

                $.ajax({
                    url:"{{route('users.getdataid')}}" + "/" + id,
                    method:"get",
                    dataType:"json",
                    success:function(result)
                    {
                        $('#id').val(result.success.id);
                        $('#name').val(result.success.name);
                        $('#role').val(result.success.role);
                        $('#phone').val(result.success.phone);
                        $('#email').val(result.success.email);
                        $('#countries_id').val(result.success.countries_id);
                        Countries(result.success.countries_id);
                        $('.avatar_view').removeClass('d-none');
                        if(result.success.type_login != null){
                            $('.avatar_view').attr('src', result.success.avatar);
                        }
                        else{
                            $('.avatar_view').attr('src', geturlphoto() + result.success.avatar);
                        }
                    }
                });

            });

            $(document).on('click', '.btn_confirm_email_current', function () {
                var id = $(this).data("id");
                if(id){
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }

                $.ajax({
                    url:"{{ route('users.confirm_email') }}",
                    method:"get",
                    data : {
                      "id" : id,
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if(result.error != null){
                            toastr.error(result.error, "Confirmed Account");
                        }
                        else{
                            toastr.success(result.success, "Confirmed Account");
                        }
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

            $(document).on('click', '.btn_delete_current', function () {
                var id = $(this).data("id");
                $('#ModDelete').modal('show');
                $('#iddel').val(id);
                if(id){
                    $('#data_Table tbody tr').css('background','transparent');
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
            });

            $('#btn_countries_search').click(function () {
                var v = $('#countries_search').val();
                Countries(v);
            });

            $('#btn_countries').change(function () {
                var v = $(this).val();
                Countries(v);
            });

            $('.btn_deleted').click(function () {
                var id = $('#iddel').val();
                $.ajax({
                    url:"{{ route('users.deleted') }}" + "/" + id,
                    method:"get",
                    dataType:"json",
                    success:function(result)
                    {
                        toastr.error(result.error, "Deleted this");
                        $('.modal').modal('hide');
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

        });

        var Countries = function (search) {
            $.ajax({
                url:"{{ route('travel.countries') }}" ,
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

        var Render_Data = function () {
            $('#data_Table').DataTable({
                "processing": true,
                "serverSide": true,
                "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    $(nRow).attr('id', aData['id']);
                },
                "ajax":{
                    "url": "{{ route('users.getdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "confirm_email" },
                    { "data": "avatar" },
                    { "data": "role" },
                    { "data": "options" }
                ]

            });
        };

    </script>
@endsection



