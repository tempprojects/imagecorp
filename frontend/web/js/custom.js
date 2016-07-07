$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.subm').click(function (e) {
        e.preventDefault();
        var imageData = $('#image-cropper').cropit('export');
        //console.log(imageData);
        $.ajax({
            data: {
                _csrf: csrfToken,
                image: imageData
            },
            url: '/test/test/*?number=1',
            type: 'post',
            success : function(data){
                //alert(1);
                //$('#foto_test').submit();
               console.log(imageData);
            }

        });
    });
});
