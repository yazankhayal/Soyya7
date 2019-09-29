@extends('layouts.app')

@includeIf('layouts.css_home_render')

@section('title') My Orders @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2> My Orders </h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>


    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form ">
                        <div class="form_xhs text-center">

                            <table class="table data_Table table-bordered" id="data_Table">
                                <thead>
                                <th>Visitor </th>
                                <th>Resident</th>
                                <th>Finish</th>
                                <th>Statues</th>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            Render_Data();
        });


        var Render_Data = function () {
            $('#data_Table').DataTable({
                "processing": true,
                "serverSide": true,
                "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    $(nRow).attr('id', aData['id']);
                },
                "ajax":{
                    "url": "{{ route('my_orders_get_data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "visitor_id" },
                    { "data": "resident_id" },
                    { "data": "finish" },
                    { "data": "statues" }
                ]

            });
        };

    </script>

@endsection
