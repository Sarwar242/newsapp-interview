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
            $("#parent_name_div").removeClass('d-none');
            $("#parent_name").attr('required', 'required');
        } else {
            $("#clientAge").val(18);
            $("#parent_name_div").addClass('d-none');
            $("#parent_name").removeAttr('required');
        }
    });

    $('input[type=radio][name=referredRadios]').change(function () {
        if (this.value == 0) {
            $("#employee_info").removeClass('d-none');
            $("#referral_employee_id").attr('required', 'required');

            $(".others_info").addClass('d-none');
            $("#referral_from_name").val('');
            $("#referral_from_address").val('');
            $("#referral_from_note").val('');

            $("#referral_from_name").removeAttr('required');
            $("#referral_from_address").removeAttr('required');
            $("#referral_from_note").removeAttr('required');
        } else {
            $("#employee_info").addClass('d-none');
            $('#referral_employee_id').removeAttr('required');

            $(".others_info").removeClass('d-none');
            $("#referral_from_name").attr('required', 'required');
            $("#referral_from_address").attr('required', 'required');
            $("#referral_from_note").attr('required', 'required');

            $('#referral_employee_id').val('');
        }
    });

    $("#attachmentButton").on('click', function () {
        $("#attchment_name").removeClass('d-none');
    });
});

$(document).ready(function () {
    var i = 1;
    $("#add").click(function () {
        i++;
        $('#dynamic_field').append('<div class="row mt-2" id="row' + i + '">' +
            '<div class="col-xl-5 col-md-4 col-sm-4 col-12">' +
            '<input type="text" name="name[]" placeholder="Enter Name" class="form-control name_list" /> ' +
            '</div>' +

            '<div class="col-xl-5 col-md-5 col-sm-5 col-12">' +
                '<div class="file-upload-section d-flex d-inline-flex">'+
                 '   <input name="images[]" type="file" class="form-control d-none attached_file" allowed="*">'+
                 '       <div class="input-group">'+
                 '           <input type="text" class="form-control file-upload-info" disabled="" readonly'+
                 '               placeholder="Size: 200x200 and max 500kB">'+
                 '           <span>'+
                 '               <button class="file-upload-browse btn btn-outline-secondary pb-3"'+
                 '                   type="button"><i class="fas fa-upload"></i> Browse</button>'+
                 '           </span>'+
                 '       </div>'+
                 '       <div class="display-input-image display-input-image2 d-none">'+
                 '           <img src="" width="120" alt="Preview Image" />'+
                 '<button type="button" class="img-x btn btn-sm btn-outline-danger file-upload-remove" title="Remove">x</button>' +
                 '       </div>'+
                 '   </div>'+
                '</div>' +

            '    <div class="col-xl-1 col-md-2 col-sm-2 mt-2">' +
            '        <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm icon-btn ms-3 mt-2 btn_remove"><i class="fas fa-close"></i></button>' +
            '    </div>' +
            '</div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
});

