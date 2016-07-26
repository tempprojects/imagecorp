jQuery(document).ready(function ($) {
//alert(1);
    if(localStorage.getItem("imgData")){
        $('img.cropit-preview-image').attr('src', localStorage.getItem("imgData"));
        $('#photosubmit.button.primary').removeClass('is-disabled');
        $('#photosubmit.button.primary').addClass('ready');
    };
    var i=1;
    for(i; i<=20; i++){
        $('#foto_test'+i).submit(function(e) {
            var imageData = $('#image-cropper').cropit('export');
            if(imageData){
                localStorage.setItem("imgData", imageData);
            }

        });
    }


});
jQuery(document).ready(function ($) {
    $('.color-list li input').click(function(){
        console.log($ (this).attr('data-value'));
    });
    
    
});