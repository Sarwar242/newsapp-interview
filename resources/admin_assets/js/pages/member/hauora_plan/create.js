$(document).ready(function () {
    $('#summernote').summernote({
        height: 400
    });
    
    $("#service").select2({
        placeholder: "Select Values",
        allowClear: true
    });

    $("#employee").select2({
        placeholder: "Select Values",
        allowClear: true
    });

    $('.select-box').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).trigger("focus");
    });

    $('.select-box').on('focus', function (e) {
        e.stopPropagation();
        $(this).css('outline', 'none');
        $(this).css('border', 'solid 1px white');
    });

    $('#plan_type').change(function() {
        if(this.value == 'joint'){
            $("#employee").val([]).trigger('change');
            $("#employee").prop('multiple', true).select2({
                placeholder: "Select Values",
                allowClear: true,
            });
        }else{
            $("#employee").prop('multiple', false).select2({
                placeholder: "Select Values", 
                allowClear: true
            });
        }
    });

});

    

