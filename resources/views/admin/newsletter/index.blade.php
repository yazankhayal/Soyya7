@extends('layouts.dashboard')

@section('title')
    Newsletter
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Newsletter
                        <small>
                            initialized
                        </small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <button type="button" class="btndeleteall btn btn-primary">
                Delete all messages
            </button>
            <hr>
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <table class="table data_Table table-bordered" id="data_Table">
                    <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Options</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModDeleteAll" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Deletion all process</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <input id="iddel" name="id" type="hidden">
                    <p class="text-danger">
                        are sure of the deleting all process
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn_deleted_all btn btn-danger">Yes,sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

            Render_Data();

            $('.btndeleteall').click(function () {
                $('#ModDeleteAll').modal('show');
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
                    url:"{{ route('newsletter.deleted') }}" + "/" + id,
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

            $('.btn_deleted_all').click(function () {
                $.ajax({
                    url:"{{ route('newsletter.deleted_all') }}",
                    method:"get",
                    dataType:"json",
                    success:function(result)
                    {
                        toastr.error(result.error, "Deleted all this");
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
                    "url": "{{ route('newsletter.getdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "email" },
                    { "data": "options" }
                ]

            });
        };

    </script>

@endsection
