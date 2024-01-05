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

    $("#memberEthnicity").select2({
        placeholder: "Select One",
        allowClear: true
    });    
    
    $("#memberIwi").select2({
        placeholder: "Select One",
        allowClear: true
    });    
    
    $("#memberJobTitle").select2({
        placeholder: "Select One",
        allowClear: true
    });

    $("#memberEmploymentType").select2({
        placeholder: "Select One",
        allowClear: true
    });   

    $('#memberEmpStatus').select2({
        placeholder: "Select One",
        allowClear: true
    });
    
    $("#memberType").select2({
        placeholder: "Select One",
        allowClear: true
    });    
    
    $("#memberEntitlementToWork").select2({
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
        $("#progressbar-2 li").eq($("fieldset").index(next_fs)).addClass("active");

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
        $("#progressbar-2 li").eq($("fieldset").index(current_fs)).removeClass("active");

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
    })

});




// Next button disabled for required field validation
$(document).ready(function () {

    // Personal Form Validations
    if($('#userFName').val() == '' || $('#userLName').val() == '' || $('#userEmail').val() == '' ||
        $('#userPhone').val() == '' || $('#userDob').val() == '' || $('#userGender').val() == null ||
        $('#userPronoun').val() == null || $('#userLocation').val() == null
    ){
        $('#personalNext').attr('disabled','disabled');
        $('#personalNext').attr('title','Please fill-up all required fields');

    }else{
        $('#personalNext').removeAttr('disabled');
    }

    // Basic Form Validations
    if($('#memberEthnicity').val() == null || $('#memberIwi').val() == null || $('#preferredContactType').val() == null ||
        $('#memberEntitlementToWork').val() == null
    ){
        $('#basicNext').attr('disabled','disabled');
        $('#basicNext').attr('title','Please fill-up all required fields');

    }else{
        $('#basicNext').removeAttr('disabled');
    }


    // Address form validations
    if($('#homeStreetAddress').val() == '' || $('#homeSubRoad').val() == '' || $('#homeCity').val() == '' ||
        $('#homePostCode').val() == '' || $('#postalStreetAddress').val() == '' || $('#postalSubRoad').val() == '' ||
        $('#postalCity').val() == '' || $('#postalPostCode').val() == ''
    ){
        $('#addressNext').attr('disabled','disabled');
        $('#addressNext').attr('title','Please fill-up all required fields');

    }else{
        $('#addressNext').removeAttr('disabled');
    }


    // Emergency Contact form Validations
    if($('#emergencyContactName').val() == '' || $('#emergencyContactMobile').val() == '' || $('#emergencyContactRelationship').val() == ''){

        $('#emergencyNext').attr('disabled','disabled');
        $('#emergencyNext').attr('title','Please fill-up all required fields');

    }else{
        $('#emergencyNext').removeAttr('disabled');
    }

});


// Personal Form Validations
$('#userFName, #userLName, #userEmail, #userPhone, #userPassword, #userCPassword, #userDob, #userGender, #userPronoun, #userLocation')
.on('keyup, click, change', function () {

    if($('#userFName').val() == '' || $('#userLName').val() == '' || $('#userEmail').val() == '' ||
        $('#userPhone').val() == '' || $('#userPassword').val() == '' || $('#userCPassword').val() == '' ||
        $('#userDob').val() == '' || $('#userGender').val() == null || $('#userPronoun').val() == null || $('#userLocation').val() == null
    ){
        $('#personalNext').attr('disabled','disabled');
        $('#personalNext').attr('title','Please fill-up all required fields');

    }else{
        $('#personalNext').removeAttr('disabled');
    }
});


// Basic form validation
$('#memberEthnicity, #memberIwi, #preferredContactType, #memberEntitlementToWork')
.on('keyup, click, change', function () {

    if($('#memberEthnicity').val() == null || $('#memberIwi').val() == null || $('#preferredContactType').val() == null ||
        $('#memberEntitlementToWork').val() == null
    ){
        $('#basicNext').attr('disabled','disabled');
        $('#basicNext').attr('title','Please fill-up all required fields');

    }else{
        $('#basicNext').removeAttr('disabled');
    }
});


// Address form validations
$(document).on('keyup, click, change', '#homeSubRoad, #homeCity, #homePostCode, #postalStreetAddress, #postalSubRoad, #postalCity, #postalPostCode, #sameAddress',function(){

    if($('#homeStreetAddress').val() == '' || $('#homeSubRoad').val() == '' || $('#homeCity').val() == '' ||
        $('#homePostCode').val() == '' || $('#postalStreetAddress').val() == '' || $('#postalSubRoad').val() == '' ||
        $('#postalCity').val() == '' || $('#postalPostCode').val() == ''
    ){
        $('#addressNext').attr('disabled','disabled');
        $('#addressNext').attr('title','Please fill-up all required fields');

    }else{
        $('#addressNext').removeAttr('disabled');
    }
});


// Emergency Contact form Validations
$('#emergencyContactName, #emergencyContactMobile, #emergencyContactRelationship')
.on('keyup, click, change', function () {

    if($('#emergencyContactName').val() == '' || $('#emergencyContactMobile').val() == '' || $('#emergencyContactRelationship').val() == ''){

        $('#emergencyNext').attr('disabled','disabled');
        $('#emergencyNext').attr('title','Please fill-up all required fields');

    }else{
        $('#emergencyNext').removeAttr('disabled');
    }
});
