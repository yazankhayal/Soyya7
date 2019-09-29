@extends('layouts.dashboard')

@section('title')
    Tourism Companies
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <style>
        .dz-remove
        {
            display:inline-block !important;
            width:1.2em;
            height:1.2em;

            position:absolute;
            top:5px;
            right:5px;
            z-index:1000;

            font-size:1.5em !important;
            line-height:1em;

            text-align:center;
            font-weight:bold;
            border:1px solid gray !important;
            border-radius:1.2em;
            color:#fff;
            background-color:red;
            opacity:.7;

        }

        .dz-remove:hover
        {
            text-decoration:none !important;
            opacity:1;
        }
    </style>
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Tourism Companies
                        <small>
                            tourism_companies
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
                        <a href="{{route('tourism_companies.add_edit')}}" class="btn btn-primary">
                            Create new
                        </a>
                    </div>
                </div>
            </div>
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <table class="table data_Table table-bordered" id="data_Table">
                    <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>User</th>
                    <th>Countries</th>
                    <th>Options</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="modal" id="Modalfile" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="ajaxForm tourism_companies_file dropzone" id="dropzone" enctype="multipart/form-data" data-name="tourism_companies_file" action="{{route('tourism_companies.tourism_companies_file')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h5 class="modal-title title">Upload new files</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="id_file" name="id" class="cls" type="hidden">
                        <div style="margin: 10px 0;">
                            <div  id="render_gallery"  class="row">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script >

        Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        var ary  = [];

        $(function () {
            'use strict';

            $('#fileupload').ajaxForm({
                beforeSend: function () {
                    $('.percent').width('0%').html('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $('.percent').width(percentComplete + '%').html(percentComplete + '%');
                },
                success: function (data) {
                    $('.percent').width('100%').html('100%');
                    ary.push(data);
                    loo();
                },
                error: function (xhr) {
                    $('.percent').width('0%').html('0%');
                },
                complete: function (xhr) {
                    $('.percent').width('0%').html('0%');
                    $('#fileupload #img').val('');
                }
            });

            $(document).on('click', '.btnremove', function () {
                var id = $(this).data("id");
                var id2  = id.substr(8);
                $.ajax({
                    url: "{{ route('tourism_companies.file_deleted') }}" + "/" + id2,
                    method: 'get',
                    data: {
                    },
                    success: function(result){
                        if(result.success != "" ){
                            toastr.success(result.success);
                            ary.shift(result.name);
                            loo();
                        }
                    }});
            });

        });

        var loo = function () {
            var st = '';
            for(var i = 0; i < ary.length ; i++){
                st += ',' + ary[i].data;
            }
            $('#gallery').val(st);
        };

    </script>
    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 122,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                removedfile: function(file)
                {
                    var name = file.upload.filename;
                    $.ajax({
                        url: "{{ route('tourism_companies.file_deleted') }}",
                        method: 'get',
                        data: {filename: name},
                        success: function(result){
                            toastr.success('Done deleted photo');
                            ary.shift(result);
                            loo();
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                dictRemoveFile : "×",
                timeout: 5000,
                success: function(file, response)
                {
                    ary.push(response);
                    loo();
                },
                error: function(file, response)
                {
                    return false;
                },
            };
    </script>

    <script type="text/javascript">

        $(document).ready(function() {

            Render_Data();

            var name_form = $('.ajaxForm').data('name');

            $.fn.dataTable.ext.errMode = 'none';
            $('#data_Table').on( 'error.dt', function ( e, settings, techNote, message ) {
                console.log( 'An error has been reported by DataTables: ', message );
            } ) .DataTable();
            $('#data_Table').DataTable();

            $(document).on('click', '.btn_gallery_current', function () {
                var id = $(this).data("id");
                $('#Modalfile').modal('show');
                $('#id_file').val(id);
                if(id){
                    $('#data_Table tbody tr').css('background','transparent');
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
                gallery(id);
                $('.dz-message').css('display','block');
                $('.dz-preview').remove();
            });

            $(document).on('click', '.btn_remove_hidden', function () {
                $('.div_result_img').addClass('hidden');
                $('.div_result_img img').attr('src','');
            });

            $(document).on('click', '.review_img', function () {
                var img = $(this).data("img");
                $('.div_result_img').removeClass('hidden');
                $('.div_result_img img').attr('src',img);
            });

            $(document).on('click', '.btn_remove_gallery', function () {
                var id = $(this).data("id");
                $.ajax({
                    url: "{{ route('tourism_companies.file_deleted_by_id') }}" + "/" + id,
                    method: 'get',
                    data: {
                    },
                    success: function(result){
                        if(result.success != "" ){
                            toastr.success(result.success);
                            gallery($('#id_file').val());
                        }
                    }});
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
                    url:"{{ route('tourism_companies.deleted') }}" + "/" + id,
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

        var gallery = function (x) {
            $.ajax({
                url:"{{ route('tourism_companies.attachments') }}" + "/" + x,
                method:"get",
                dataType:"json",
                success:function(result)
                {
                    $('#render_gallery').html('');
                    for(var i = 0; i < result.data.length ; i++){
                        var image = result.data[i].name;
                        var id = result.data[i].id;
                        var r = '<div class="col-md-3" style="margin-right: 10px;">\n' +
                            '                                <div class="media">\n' +
                            '                                    <img data-img="'+ geturlphoto() + 'tourism_companies_file/' + image +'" style="width:100%;height: 60px;" src="'+ geturlphoto() + 'tourism_companies_gallery/' + image +'" class="review_img mr-3" alt="...">\n' +
                            '                                    <div class="media-body">\n' +
                            '                                        <h5 class="btn_remove_gallery" data-id="'+ id +'" class="mt-0">\n' +
                            '                                            <i class="fa fa-trash"></i>\n' +
                            '                                        </h5>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>';
                        $('#render_gallery').append(r);
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
                    "url": "{{ route('tourism_companies.getdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "avatar" },
                    { "data": "user_id" },
                    { "data": "countries_id" },
                    { "data": "options" }
                ]

            });
        };

    </script>

@endsection



