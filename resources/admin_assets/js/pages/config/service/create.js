$(document).ready(function () {
    $('#summernote').summernote({
        height: 280
    });

    $("#service_manager, #location, #kaimahi_ids").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $('#service-form').on('submit', function(e) {
        if($('#summernote').summernote('isEmpty')) {
            notify('Note is empty, fill it!', 'warning');
          e.preventDefault();
        }
    });

});



