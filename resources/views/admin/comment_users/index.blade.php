@extends('layouts.dashboard')

@section('title')
    Comment Users
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Comment Users
                        <small>
                            initialized
                        </small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <table class="table data_Table table-bordered" id="data_Table">
                    <thead>
                    <th width="10%">Id</th>
                    <th width="10%">Name</th>
                    <th width="15%">Post</th>
                    <th width="10%">User</th>
                    <th width="10%">Approval Comment</th>
                    <th width="10%">Options</th>
                    </thead>
                </table>
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

            $(document).on('click', '.btn_approve_yes', function () {
                var id = $(this).data("id");
                if(id){
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
                $.ajax({
                    url:"{{ route('comment_users.approve') }}",
                    method:"get",
                    data : {
                        "id" : id,
                        "type" : "yes",
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if(result.error != null){
                            toastr.error(result.error, "Approved Comment");
                        }
                        else{
                            toastr.success(result.success, "Approved Comment");
                        }
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

            $(document).on('click', '.btn_approve_no', function () {
                var id = $(this).data("id");
                if(id){
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
                $.ajax({
                    url:"{{ route('comment_users.approve') }}",
                    method:"get",
                    data : {
                        "id" : id,
                        "type" : "no",
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        if(result.error != null){
                            toastr.error(result.error, "Approved Comment");
                        }
                        else{
                            toastr.success(result.success, "Approved Comment");
                        }
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

            $('.btn_deleted').click(function () {
                var id = $('#iddel').val();
                $.ajax({
                    url:"{{ route('comment_users.deleted') }}" + "/" + id,
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
                    "url": "{{ route('comment_users.getdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "post_id" },
                    { "data": "user_id" },
                    { "data": "approve" },
                    { "data": "options" }
                ]

            });
        };

    </script>
@endsection



