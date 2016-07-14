var locat = window.location.search;
//console.log(locat);
jQuery(document).ready(function ($) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var form = $(document).find('form').attr('id');
    //console.log(form);


    $('#'+form).submit(function(e) {
        var imageData = $('#image-cropper').cropit('export');
        $.ajax({
            data : {_csrf : csrfToken, image: imageData},
            url: '/test/test/*'+locat,
            type: 'post',
        });
    });

});
