var geturlphoto = function () {
    return '/';
};

var Render_Data = function () {

};

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

$(document).ready(function () {

    $('.btncreate').click(function () {
        $('.form-control').removeClass('border-danger');
        $('span.error').remove();
        $('.avatar_view').addClass('d-none');
    });

    $(document).ajaxStart(function () {
        NProgress.start();
    });
    $(document).ajaxStop(function () {
        NProgress.done();
    });
    $(document).ajaxError(function () {
        NProgress.done();
    });

    $('.ajaxForm').submit(function (event) {
        event.preventDefault(); //prevent default action
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = new FormData(this); //Encode form elements for submission
        var name = $(this).data('name');
        var current_data = $(this).serializeArray();
        var id_current_data = current_data[1]['value']
        var old_name_Su = $("."+ name +" .btn-load").html();
        $.ajax({
            url : post_url,
            type: request_method,
            data : form_data,
            beforeSend: function() {
                // setting a timeout
                $("."+ name +" .btn-load").html("Loading...");
                $("."+ name +" .btn-load").prop("disabled", true);
            },
            contentType: false,
            processData:false,
            xhr: function(){
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function(event) {
                        $("."+ name +" .btn").prop("disabled", true);
                    }, true);
                }
                return xhr;
            }
        }).done(function(data){
            $("."+ name +" .btn-load").html(old_name_Su);
            $("."+ name +" .btn-load").prop("disabled", false);
            if(data.errors != null)
            {
                $("."+ name +" .btn").prop("disabled", false);
                $('.'+name+' .error').remove();
                $('.'+name+' .form-control').removeClass('border-danger');
                $.each(data.errors ,function (index,val) {
                    toastr.error(val);
                    $('.'+name+' #'+index).addClass('border-danger');
                    $('.'+name+' #'+index).after('<span class="error" id="error_'+ index +'" style="color: red">'+val+'</span>');
                });
            }
            else if(data.errors_add_more != null){
                $("."+ name +" .btn").prop("disabled", false);
                $('.'+name+' .error').remove();
                $('.'+name+' .form-control').removeClass('border-danger');
                $.each(data.errors_add_more ,function (index,val) {
                    toastr.error(val);
                    var str = index;
                    var array = str.split(".");
                    var req = array[2] + '_' + array[1];
                    $('.'+name+' #'+req).addClass('border-danger');
                    $('.'+name+' #'+req).after('<span class="error" id="error_'+ index +'" style="color: red">'+val+'</span>');
                });
            }
            else if (data.error != null){
                $("."+ name +" .btn").prop("disabled", false);
                toastr.error(data.error);
            }
            else
            {
                toastr.success(data.success);
                $('.'+name+' .error').remove();
                $('.'+name+' .form-control').removeClass('border-danger');
                $("."+ name +" .btn").prop("disabled", false);
                $('.form-control').val('');
                $('.sub').val('');
                if(data.url != null){
                    window.setTimeout(function(){
                        window.location.href = data.url;
                    }, 2000);
                }
                if(data.same_page == '1'){
                    Render_Data();
                }
                else{
                    $('#data_Table').DataTable().ajax.reload(null, false);
                    $('.sumernote').summernote('code','');
                    if(id_current_data){
                        $('#data_Table tbody #' + id_current_data).css('background','hsla(64, 100%, 50%, 0.36)');
                    }
                    else{
                        $('#data_Table tbody tr').css('background','transparent');
                    }
                }
                $(".modal").modal('hide');
                $(".error_f").html('');
                $(".cls_a").val('');
            }
        });
    });

});