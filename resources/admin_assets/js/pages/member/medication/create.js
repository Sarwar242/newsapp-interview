$(document).ready(function () {
    $('#summernote').summernote({
        height: 400
    });

    $('.validate_form').on('submit', function(e) {
        if($('#summernote').summernote('isEmpty')) {
            notify('Note is empty, fill it!', 'warning');
          e.preventDefault();
        }
    });
});

    

