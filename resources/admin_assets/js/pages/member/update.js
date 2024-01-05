$(document).ready(function () {
    $("#role_id").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#gender").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#pronoun").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#location").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#ethnicity").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#iwi").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#preferredContactType").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#jobTitle").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#employeeStatus").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#employmentType").select2({
        placeholder: "Select One",
        allowClear: true
    });
    $("#entitlementWork").select2({
        placeholder: "Select One",
        allowClear: true
    });
});



var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animation;

var error = false;

var current = 1;
var steps = $("fieldset").length;


// ***********************************************************
//      Step 1.   Personal Information Start
// ***********************************************************

// first name validation
$("#fname").keyup(function() {
    var fname = $("#fname").val();
    if (fname == '') {
        $("#error-fname").text('Enter your first name.');
        $("#fname").addClass("box_error");
        error = true;
    } else {
        $("#error-fname").text('');
        error = false;
    }
    if (!isNaN(fname)) {
        $("#error-fname").text("Only characters are allowed.");
        $("#fname").addClass("box_error");
        error = true;
    } else {
        $("#fname").removeClass("box_error");
    }
});
// last name validation
$("#lname").keyup(function() {
    var lname = $("#lname").val();
    if (lname == '') {
        $("#error-lname").text('Enter your last name.');
        $("#lname").addClass("box_error");
        error = true;
    } else {
        $("#error-lname").text('');
        error = false;
    }
    if (!isNaN(lname)) {
        $("#error-lname").text("Only characters are allowed.");
        $("#lname").addClass("box_error");
        error = true;
    } else {
        $("#lname").removeClass("box_error");
    }
});
// work email validation
$("#workEmail").keyup(function() {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test($("#workEmail").val())) {
        $("#error-workEmail").text('Please enter an email address.');
        $("#workEmail").addClass("box_error");
        error = true;
    } else {
        $("#error-workEmail").text('');
        error = false;
        $("#workEmail").removeClass("box_error");
    }
});
// work phone validation
$("#workPhone").keyup(function() {
    var phoneReg = /^[0-9]+$/;
    var phone = $("#workPhone").val();

    if (!phoneReg.test($("#workPhone").val())) {
        $("#error-workPhone").text('Please enter an phone number.');
        $("#workPhone").addClass("box_error");
        error = true;
    } else {
        // error = false;
        $("#error-workPhone").text('');
        $("#workPhone").removeClass("box_error");
    }
    if ((phone.length <= 7) || (phone.length > 15)) {
        $("#error-workPhone").text("Mobile number must be between 8 - 15 Digits only.");
        $("#workPhone").addClass("box_error");
        error = true;
    } else {
        $("#workPhone").removeClass("box_error");
    }
});
// dob validation
$('#dob').on('change', function() {
    let dob = document.getElementById("dob").value;
    if (dob == '' || dob == null) {
        $("#error-dob").text('Please enter your Date of Birth.');
        $("#dob").addClass("box_error");
        error = true;
    } else {
        // error = false;
        $("#error-dob").text('');
        $("#dob").removeClass("box_error");
    }

});

// gender validation
$('#gender').on('change', function() {
    var gender = $(this).children(':selected').data('params');

    if (gender == '') {
        $("#error-gender").text('Enter your gender.');
        $("#gender + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-gender").text('');
        error = false;
    }
    if (!isNaN(gender)) {
        $("#error-gender").text("Please select a gender.");
        $("#gender + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#gender + .select2-container .select2-selection--single").removeClass("box_error");
    }
});
// pronoun validation
$('#pronoun').on('change', function() {
    var pronoun = $(this).children(':selected').data('params');

    if (pronoun == '') {
        $("#error-pronoun").text('Enter your pronoun.');
        $("#pronoun + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-pronoun").text('');
        error = false;
    }
    if (!isNaN(pronoun)) {
        $("#error-pronoun").text("Please select a pronoun.");
        $("#pronoun + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#pronoun + .select2-container .select2-selection--single").removeClass("box_error");
    }
});
// location validation
$('#location').on('change', function() {
    var location = $(this).children(':selected').data('params');

    if (location == '') {
        $("#error-location").text('Enter your location.');
        $("#location + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-location").text('');
        error = false;
    }
    if (!isNaN(location)) {
        $("#error-location").text("Please select a location.");
        $("#location + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#location + .select2-container .select2-selection--single").removeClass("box_error");
    }
});


// first step validation
$(".fs_next_btn").click(function() {

    // first name
    if ($("#fname").val() == '') {
        $("#error-fname").text('Enter your first name.');
        $("#fname").addClass("box_error");
        error = true;
    } else {
        var fname = $("#fname").val();
        if (fname != fname) {
            $("#error-fname").text('First name is required.');
            error = true;
        } else {
            // error = false;
            $("#error-fname").text('');
            $("#fname").removeClass("box_error");
        }
        if (!isNaN(fname)) {
            $("#error-fname").text("Only characters are allowed.");
            error = true;
        } else {
            $("#fname").removeClass("box_error");
        }
    }
    // last name
    if ($("#lname").val() == '') {
        $("#error-lname").text('Enter your last name.');
        $("#lname").addClass("box_error");
        error = true;
    } else {
        var lname = $("#lname").val();
        if (lname != lname) {
            $("#error-lname").text('Last name is required.');
            error = true;
        } else {
            // error = false;
            $("#error-lname").text('');
            $("#lname").removeClass("box_error");
        }
        if (!isNaN(lname)) {
            $("#error-lname").text("Only Characters are allowed.");
            error = true;
        } else {
            $("#lname").removeClass("box_error");
        }
    }
    // work email
    if ($("#workEmail").val() == '') {
        // $("#error-workEmail").text('Please enter an email address.');
        // $("#workEmail").addClass("box_error");
        error = false;
    } else {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test($("#workEmail").val())) {
            $("#error-workEmail").text('Please insert a valid email address.');
            error = true;
        } else {
            $("#error-workEmail").text('');
            $("#workEmail").removeClass("box_error");
        }
    }
    // phone
    if ($("#workPhone").val() == '') {
        $("#error-workPhone").text('Please enter an phone number.');
        $("#workPhone").addClass("box_error");
        error = true;
    } else {
        var phoneReg = /^[0-9]+$/;
        var phone = $("#workPhone").val();
        if (!phoneReg.test($("#workPhone").val())) {
            $("#error-workPhone").text('Please insert a valid phone number.');
            error = true;
        } else {
            $("#error-workPhone").text('');
            $("#workPhone").removeClass("box_error");
        }
        if ((phone.length <= 7) || (phone.length > 15)) {
            $("#error-workPhone").text("Mobile number must be between 8 - 15 Digits only.");
            $("#workPhone").addClass("box_error");
            error = true;
        } else {
            $("#workPhone").removeClass("box_error");
        }
    }
    // DOB
    let dob = document.getElementById("dob").value;
    if (dob == '' || dob == null) {
        $("#error-dob").text('Please enter your Date of Birth.');
        $("#dob").addClass("box_error");
        error = true;
    } else {
        // error = false;
        $("#error-dob").text('');
        $("#dob").removeClass("box_error");
    }
    // gender
    if ($("#gender").val() == '' || $("#gender").val() == null) {
        $("#error-gender").text('Please select your gender.');
        $("#gender + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-gender").text('');
        $("#gender + .select2-container .select2-selection--single").removeClass("box_error");
    }
    // pronoun
    if ($("#pronoun").val() == '' || $("#pronoun").val() == null) {
        $("#error-pronoun").text('Please select your pronoun.');
        $("#pronoun + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-pronoun").text('');
        $("#pronoun + .select2-container .select2-selection--single").removeClass("box_error");
    }
    // location
    if ($("#location").val() == '' || $("#location").val() == null) {
        $("#error-location").text('Please select your location.');
        $("#location + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-location").text('');
        $("#location + .select2-container .select2-selection--single").removeClass("box_error");
    }

    // animation
    if (!error) {
        if (animation) return false;
        animation = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        $("#progressbar-2 li").eq($("fieldset").index(next_fs)).addClass("active");

        next_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animation = false;
            },
            easing: 'easeInOutBack'
        });
        // setProgressBar(++current);
    }
});

// ***********************************************************
//      Step 1.   Personal Information End
// ***********************************************************

// ***********************************************************
//      Step 2.   Basic Information Start
// ***********************************************************

// ethnicity validation
$('#ethnicity').on('change', function() {
    var ethnicity = $(this).children(':selected').data('params');

    if (ethnicity == '') {
        $("#error-ethnicity").text('Enter your ethnicity.');
        $("#ethnicity + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-ethnicity").text('');
        error = false;
    }
    if (!isNaN(ethnicity)) {
        $("#error-ethnicity").text("Please select a ethnicity.");
        $("#ethnicity + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#ethnicity + .select2-container .select2-selection--single").removeClass("box_error");
    }
});
// iwi validation
$('#iwi').on('change', function() {
    var iwi = $(this).children(':selected').data('params');

    if (iwi == '') {
        // $("#error-iwi").text('Enter your iwi.');
        // $("#iwi + .select2-container .select2-selection--single").addClass("box_error");
        error = false;
    } else {
        $("#error-iwi").text('');
        error = false;
    }
    if (!isNaN(iwi)) {
        $("#error-iwi").text("Please select a iwi.");
        $("#iwi + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#iwi + .select2-container .select2-selection--single").removeClass("box_error");
    }
});
// preferred contact type validation
$('#preferredContactType').on('change', function() {
    var preferredContactType = $(this).children(':selected').data('params');

    if (preferredContactType == '') {
        // $("#error-preferredContactType").text('Enter your preferred contact type.');
        // $("#preferredContactType + .select2-container .select2-selection--single").addClass("box_error");
        error = false;
    } else {
        $("#error-preferredContactType").text('');
        error = false;
    }
    if (!isNaN(preferredContactType)) {
        $("#error-preferredContactType").text("Please select a preferred contact type.");
        $("#preferredContactType + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#preferredContactType + .select2-container .select2-selection--single").removeClass("box_error");
    }
});
// entitlement work validation
$('#entitlementWork').on('change', function() {
    var entitlementWork = $(this).children(':selected').data('params');

    if (entitlementWork == '') {
        $("#error-entitlementWork").text('Select One.');
        $("#entitlementWork + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-entitlementWork").text('');
        error = false;
    }
    if (!isNaN(entitlementWork)) {
        $("#error-entitlementWork").text("Client is required.");
        $("#entitlementWork + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#entitlementWork + .select2-container .select2-selection--single").removeClass("box_error");
    }
});

// second step validation
$(".ss_next_btn").click(function() {

    // ethnicity
    if ($("#ethnicity").val() == '' || $("#ethnicity").val() == null) {
        $("#error-ethnicity").text('Please select your ethnicity.');
        $("#ethnicity + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-ethnicity").text('');
        $("#ethnicity + .select2-container .select2-selection--single").removeClass("box_error");
    }
    // iwi
    if ($("#iwi").val() == '' || $("#iwi").val() == null) {
        // $("#error-iwi").text('Please select your iwi.');
        // $("#iwi + .select2-container .select2-selection--single").addClass("box_error");
        error = false;
    } else {
        $("#error-iwi").text('');
        $("#iwi + .select2-container .select2-selection--single").removeClass("box_error");
    }
    // preferred contact type
    if ($("#preferredContactType").val() == '' || $("#preferredContactType").val() == null) {
        // $("#error-preferredContactType").text('Please select preferred contact type.');
        // $("#preferredContactType + .select2-container .select2-selection--single").addClass("box_error");
        error = false;
    } else {
        $("#error-preferredContactType").text('');
        $("#preferredContactType + .select2-container .select2-selection--single").removeClass("box_error");
    }
    // entitlement work
    if ($("#entitlementWork").val() == '' || $("#entitlementWork").val() == null) {
        $("#error-entitlementWork").text('Please select one.');
        $("#entitlementWork + .select2-container .select2-selection--single").addClass("box_error");
        error = true;
    } else {
        $("#error-entitlementWork").text('');
        $("#entitlementWork + .select2-container .select2-selection--single").removeClass("box_error");
    }

    // animation
    if (!error) {
        if (animation) return false;
        animation = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        $("#progressbar-2 li").eq($("fieldset").index(next_fs)).addClass("active");

        next_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animation = false;
            },
            easing: 'easeInOutBack'
        });
        // setProgressBar(++current);
    }

});

// ***********************************************************
//      Step 2.   Basic Information End
// ***********************************************************


// previous
$(".previous").click(function() {
    if (animation) return false;
    animation = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    $("#progressbar-2 li").eq($("fieldset").index(current_fs)).removeClass("active");

    previous_fs.show();
    current_fs.animate({
        opacity: 0
    }, {
        step: function(now) {
            scale = 0.8 + (1 - now) * 0.2;
            left = ((1 - now) * 50) + "%";
            opacity = 1 - now;
            current_fs.css({
                'left': left,
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({
                'transform': 'scale(' + scale + ')',
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function() {
            current_fs.hide();
            animation = false;
        },
        easing: 'easeInOutBack'
    });
    // setProgressBar(--current);
});

function setProgressBar(curStep) {
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
        .css("width", percent + "%")
}

$(".submit").click(function() {
    if (!error){
        $('#msform').submit()
    }
    return false;
})
