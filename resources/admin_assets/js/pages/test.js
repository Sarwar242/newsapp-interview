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

    $("#clientage").on('change, keyup', function () {
        if (this.value < 18) {
            $("#parent_name").removeClass('d-none');
        } else {
            $("#parent_name").addClass('d-none');
        }
    });

    $('input[type=radio][name=referredRadios]').change(function () {
        if (this.value == 0) {
            $("#employee_info").removeClass('d-none');
            $("#others_info").addClass('d-none');

            $("#referral_from_name").val('');
            $("#referral_from_address").val('');
            $("#referral_from_note").val('');
        } else {
            $("#employee_info").addClass('d-none');
            $("#others_info").removeClass('d-none');

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
            '<div class="col-md-4">' +
            '<input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /> ' +
            '</div>' +

            '<div class="col-xl-4 col-sm-6 col-12">' +
                '<div class="file-upload-section d-flex d-inline-flex">'+
                 '   <input name="images[]" type="file" class="form-control d-none" allowed="*">'+
                 '       <div class="input-group w-75">'+
                 '           <input type="text" class="form-control file-upload-info" disabled="" readonly'+
                 '               placeholder="Size: 200x200 and max 500kB">'+
                 '           <span>'+
                 '               <button class="file-upload-browse btn btn-outline-secondary pb-3"'+
                 '                   type="button"><i class="fas fa-upload"></i> Browse</button>'+
                 '           </span>'+
                 '       </div>'+
                 '       <div class="display-input-image display-input-image2 d-none w-25">'+
                 '           <img src="" alt="Preview Image" />'+
                 '       </div>'+
                 '   </div>'+
                '</div>' +

            '    <div class="col-md-2">' +
            '        <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm icon-btn ms-3 mb-2 btn_remove"><i class="fas fa-close"></i></button>' +
            '    </div>' +
            '</div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
});
