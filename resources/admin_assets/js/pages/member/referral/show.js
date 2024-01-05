const updateReferralModal = "#updateReferralModal";
const updateReferralForm = "#updateReferralForm";
let type = 'status';

function resetReferralFields() {
    $('#notes').css('display', 'unset').val('');
    $('#statusField').addClass('d-none');
    $('#rereferEmployeeField').addClass('d-none');
    $('#status').prop('disabled', 'disabled');
    $('#refer_to').prop('disabled', '');
    $('#declinedField').addClass('d-none');
    $('#declinedBy').prop('required', '');
    $('#rereferStatus').addClass('d-none');
    $('#rereferStatus').prop('disabled', 'disabled');
}

window.clickRereferAction = function () {
    resetReferralFields();
    type = 're-refer';
    $('#rereferEmployeeField').removeClass('d-none');
    $('#rereferStatus').removeClass('d-none');
    $('#rereferStatus').prop('disabled', '');
    $('#referralModalLabel').html('<i class="fas fa-plus"></i> Re-refer');
    $(updateReferralModal).modal('show');
}

window.clickChangeStatusAction = function () {
    resetReferralFields();
    type = 'status';
    $('#statusField').removeClass('d-none');
    $('#rereferStatus').addClass('d-none');
    $('#status').prop('disabled', '');
    $('#rereferStatus').prop('disabled', 'disabled');
    $('#referralModalLabel').text('Change Status');
    $('#status').find(":selected").val() == 'declined' ? $('#declinedField').removeClass('d-none') : $('#declinedField').addClass('d-none');
    $('#status').on('change', function () {
        if ($(this).find(":selected").val() == 'declined') {
            $('#declinedBy').prop('required', 'required');
            $('#declinedField').removeClass('d-none');
        } else {
            $('#declinedBy').prop('required', '');
            $('#declinedField').addClass('d-none');
        }
    });

    $(updateReferralModal).modal('show');
}


window.updateReferral = function (e, t) {
    e.preventDefault();
    const id = $(updateReferralForm).find("input[name='referral_id']").val();
    let url = BASE_URL;

    if (type == 'status') {
        url = BASE_URL + '/referrals/' + id + '/status-update-api';
    } else {
        url = BASE_URL + '/referrals/' + id + '/rerefer-api';
    }
    
    var form_data = $(t).serialize();

    loading('show');
    axios.post(url, form_data)
        .then(response => {
            $(updateReferralModal).modal('hide');
            notify(response.data.message, 'success');

            $('#reloadShowDiv').load(' #reloadShowDiv')
        })
        .catch(error => {
            const response = error.response;
            if (response) {
                if (response.status === 422)
                    validationForm(updateReferralForm, response.data.errors);
                else
                    notify(response.data.message, 'error');
            }
        })
        .finally(() => {
            loading('hide');
        });
}
