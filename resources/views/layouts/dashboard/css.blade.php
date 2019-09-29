<!--begin::Web font -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!--end::Web font -->
<!--begin::Base Styles -->
<!--begin::Page Vendors -->
<link href="{{url($get_url_photo.'dashboard/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors -->
<link href="{{url($get_url_photo.'dashboard/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url($get_url_photo.'dashboard/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css">
<link rel="stylesheet" href="{{url($get_url_photo.'nprogress-master/nprogress.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.3/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<!--end::Base Styles -->
<link rel="shortcut icon" href="{{$get_url_photo}}home/img/logo.png" />
<style>
    .form-control{
        height: 38px;
    }
    .data_table_css_button a i{
        color: #fff;
    }
</style>