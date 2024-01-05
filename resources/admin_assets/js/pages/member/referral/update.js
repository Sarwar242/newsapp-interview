$(document).ready(function () {
    $('#summernote').summernote({
        height: 200
    });

    $("#service_id").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#referral_employee_id").select2({
        placeholder: "Select One",
        allowClear: true
    });    
    
    $("#client_id").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#refer_to").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#client_id").on('change', function () {
        var element = $(this).find('option:selected'); 
        var isAdult = element.attr("isAdult"); 
        
        if (!isAdult) {
            $("#clientAge").val(17);
            $("#parent_name").removeClass('d-none');
        } else {
            $("#clientAge").val(18);
            $("#parent_name").addClass('d-none');
        }
    });

    $('input[type=radio][name=referredRadios]').change(function () {
        if (this.value == 0) {
            $("#employee_info").removeClass('d-none');
            $(".others_info").addClass('d-none');
            $("#referral_employee_id").attr('required', 'required');
            $("#referral_from_name").val('');
            $("#referral_from_address").val('');
            $("#referral_from_note").val('');
        } else {
            $("#employee_info").addClass('d-none');
            $(".others_info").removeClass('d-none');

            $('#referral_employee_id').val('');
        }
    });

    $("#attachmentButton").on('click', function () {
        $("#attchment_name").removeClass('d-none');
    });
});
