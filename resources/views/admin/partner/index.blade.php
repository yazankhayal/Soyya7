@extends('layouts.dashboard')

@section('title')
    Partner
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Partner
                        <small>
                            partner
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
                    <th>Image</th>
                    <th>Link</th>
                    <th>Options</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="ajaxForm partner" enctype="multipart/form-data" data-name="partner" action="{{route('partner.postdata')}}" method="post">
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
                            <label for="link">Link</label>
                            <input type="text" class="cls form-control" name="link" id="link" placeholder="Enter Link">
                        </div>
                        <div class="form-group">
                            <label for="avatar">Image</label>
                            <input type="file" class="cls form-control" name="img" id="img">
                            <br>
                            <img style="width: 200px;height: 200px;" class="avatar_view d-none img-thumbnail" >
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
                $('#cbody').summernote('code','');
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
                    url:"{{route('partner.getdataid')}}" + "/" + id,
                    method:"get",
                    dataType:"json",
                    success:function(result)
                    {
                        $('#id').val(result.success.id);
                        $('#name').val(result.success.name);
                        $('#description').val(result.success.description);
                        $('#tags').val(result.success.tags);
                        $('#cbody').summernote('code',result.success.body);
                        $('#type').val(result.success.type);
                        $('.avatar_view').removeClass('d-none');
                        $('.avatar_view').attr('src', geturlphoto() + result.success.avatar);
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

            $('.btn_deleted').click(function () {
                var id = $('#iddel').val();
                $.ajax({
                    url:"{{ route('partner.deleted') }}" + "/" + id,
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

        var Render_Data = function () {
            $('#data_Table').DataTable({
                "processing": true,
                "serverSide": true,
                "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    $(nRow).attr('id', aData['id']);
                },
                "ajax":{
                    "url": "{{ route('partner.getdata') }}",
                    "dataType": "json",
                    "type": "post",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "avatar" },
                    { "data": "link" },
                    { "data": "options" }
                ]

            });
        };

    </script>
@endsection



