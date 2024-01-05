$(document).ready(function () {

    $("#users").select2({
        placeholder: "Select One",
        allowClear: true
    });


    $('#summernote').summernote({
        height: 400,
        placeholder: "Write Description (Required)*",
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
    });

});

$(document).ready(function () {
    var counter = 0;
    $(document).on('click', '.add-btn', function () {
        var whole_extra_item_add = $('#qus_col').html();
        $("#qus_row").append(whole_extra_item_add);
        counter++;
        checkIsBtnDisabled();

    });
    $(document).on('click', '.removeeventmore', function () {
        $(this).closest('.delete_extra_item').remove();
        counter -= 1;
        checkIsBtnDisabled();
    });

    $(document).on('click', '.add-yes-no-btn', function () {
        var whole_extra_item_add = $('#yes_no_qus_col').html();
        $("#qus_row").append(whole_extra_item_add);
        counter++;
        checkIsBtnDisabled();
    });

    window.RemoveQus = function (id)
    {
        var route = BASE_URL + "/posts/question/"+id+"/delete";
        console.log(route);
        confirmFormModal(route, 'Confirmation', 'Are you sure Remove It. ');
        
        setTimeout(function(){
            window.reload();
        }, 2000);
    }

    function checkIsBtnDisabled() {
        var size = $('#count_question').val();
        var total = parseInt(size)+parseInt(counter); 
        if(total >= 3){
            $("#postUpdateSubmitBtn").removeAttr('disabled');
            $("#btn-warning").addClass('d-none');
        }else{
            $("#postUpdateSubmitBtn").attr('disabled', 'disabled');
            $("#btn-warning").removeClass('d-none');
        }
    };
});

$(document).on('change', '#users', function () {
    if(this.value == 'all'){
        $('#users option').prop('selected', true);
        $('#users option[value="all"]').prop('selected', false).trigger('change');
    }
}).change();



