$(document).ready(function () {

    $("#role_id").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#userGender").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#userPronoun").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#userLocation").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeEthnicity").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeIwi").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeJobTitle").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeEmploymentType").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeEmployeeType").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#employeeEntitlementToWork").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#team").select2({
        placeholder: "Select One",
        allowClear: true
    });

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function () {
        return true;
    });

});

// Next button disabled for required field validation
$(document).ready(function () {

    // Personal Form Validations
    if ($('#userFName').val() == '' || $('#userLName').val() == '' || $('#userEmail').val() == '' ||
        $('#userPhone').val() == '' || $('#userDob').val() == '' || $('#userGender').val() == null ||
        $('#userPronoun').val() == null || $('#userLocation').val() == null
    ) {
        $('#personalNext').attr('disabled', 'disabled');
        $('#personalNext').attr('title', 'Please fill-up all required fields');

    } else {
        $('#personalNext').removeAttr('disabled');
    }

    // Basic Form Validations
    if ($('#employeeEthnicity').val() == null || $('#employeeIwi').val() == null ||
        $('#employeeWorkPhone').val() == '' || $('#employeeJobTitle').val() == null ||
        $('#employeeEmploymentType').val() == null || $('#employeeEmployeeType').val() == null || $('#employeeEntitlementToWork').val() == null
    ) {
        $('#basicNext').attr('disabled', 'disabled');
        $('#basicNext').attr('title', 'Please fill-up all required fields');

    } else {
        $('#basicNext').removeAttr('disabled');
    }


    // Security form validation
    // if ($('#role_id').val() == '' || $('#role_id').val() == null) {

    //     $('#securitySubmit').attr('disabled', 'disabled');
    //     $('#securitySubmit').attr('title', 'Please fill-up all required fields');

    // } else {
    //     $('#securitySubmit').removeAttr('disabled');
    // }

});

// Personal Form Validations
$('#userFName, #userLName, #userEmail, #userPhone, #userDob, #userGender, #userPronoun, #userLocation')
    .on('keyup, click, change', function () {

        if ($('#userFName').val() == '' || $('#userLName').val() == '' || $('#userEmail').val() == '' ||
            $('#userPhone').val() == '' || $('#userDob').val() == '' || $('#userGender').val() == null ||
            $('#userPronoun').val() == null || $('#userLocation').val() == null
        ) {
            $('#personalNext').attr('disabled', 'disabled');
            $('#personalNext').attr('title', 'Please fill-up all required fields');

        } else {
            $('#personalNext').removeAttr('disabled');
        }
    });


// Basic form validation
$('#employeeEthnicity, #employeeIwi, #employeeWorkPhone, #employeeJobTitle, #employeeEmploymentType, #employeeEmployeeType, #employeeEntitlementToWork')
    .on('keyup, click, change', function () {

        if ($('#employeeEthnicity').val() == null || $('#employeeIwi').val() == null ||
            $('#employeeWorkPhone').val() == '' || $('#employeeJobTitle').val() == null ||
            $('#employeeEmploymentType').val() == null || $('#employeeEmployeeType').val() == null || $('#employeeEntitlementToWork').val() == null
        ) {
            $('#basicNext').attr('disabled', 'disabled');
            $('#basicNext').attr('title', 'Please fill-up all required fields');

        } else {
            $('#basicNext').removeAttr('disabled');
        }
    });


// // Security form validation
// $('#role_id').on('keyup, click, change', function () {

//     if ($('#role_id').val().length == 0 || $('#role_id').val() == null) {

//         $('#securitySubmit').attr('disabled', 'disabled');
//         $('#securitySubmit').attr('title', 'Please fill-up all required fields');

//     } else {
//         $('#securitySubmit').removeAttr('disabled');
//     }
// });

$('.user-type-radio').change(function() {
    if ($(this).val() == 'admin') {
        $('#role').removeClass('d-none')
    } else if ($(this).val() == 'employee') {
        $('#role').addClass('d-none')
    }
});
