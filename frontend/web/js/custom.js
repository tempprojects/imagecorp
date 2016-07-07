$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('#foto_test').submit(function(e) {
        var imageData = $('#image-cropper').cropit('export');
        $.ajax({
            data : {_csrf : csrfToken, image: imageData},
            url: '/test/test/*?number=1',
            type: 'post',
        });
    });
});
