var progressbar     = $('.progress-bar');
$(".submit-referensi-cemilan").click(function(){
    $(".submit-referensi-cemilan").prop("disabled", true).css("cursor", 'not-allowed');
    $(".loading-button").css("display", 'inline-block');
        $("#form-add-referensi-cemilan").ajaxForm({
            target: '.preview',
            beforeSend: function() {
                $(".progress").css("display","block");
                progressbar.width('0%');
                progressbar.text('0%');
            },
            uploadProgress: function (event, position, total, percentComplete) {
                progressbar.width(percentComplete + '%');
                progressbar.text(percentComplete + '%');
            },
            success: function(data) {
                if(data.status == 'success'){
                    $('.pesan').removeClass('alert alert-danger');
                    $('.pesan').addClass('alert alert-success');
                    $('.pesan').html(data.message);
                    $(".submit-referensi-cemilan").prop("disabled", false).css("cursor", 'pointer');
                    $(".loading-button").css("display", 'none');
                    $(this).closest('form').find("input[type=text], textarea").val("");
                    $('#thanks_for_submit').modal('show');
                    setTimeout(function(){
                         location.reload();
                    }, 5000);
                }else if (data.status == 'failed'){
                    $('.pesan').removeClass('alert alert-success');
                    $('.pesan').addClass('alert alert-danger');
                    $('.pesan').html(data.message);
                    $(".submit-referensi-cemilan").prop("disabled", false).css("cursor", 'pointer');
                    $(".loading-button").css("display", 'none');
                }else{
                    var errorString = '';
                    $.each( data.message, function( key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    $('.pesan').removeClass('alert alert-success');
                    $('.pesan').addClass('alert alert-danger');
                    $('.pesan').html(errorString);
                    $(".submit-referensi-cemilan").prop("disabled", false).css("cursor", 'pointer');
                    $(".loading-button").css("display", 'none');
                }
                $('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
            }
            })
        .submit();
});