jQuery(document).ready(function ($) {
    if(localStorage.getItem("imgData")){
        $('img.cropit-preview-image').attr('src', localStorage.getItem("imgData"));
        $('#photosubmit.button.primary').removeClass('is-disabled');
        $('#photosubmit.button.primary').addClass('ready');
    };
    
    $('#foto_test').submit(function(e) {
        var imageData = $('#image-cropper').cropit('export');
        if(imageData){
             localStorage.setItem("imgData", imageData);
        }
    });
});
