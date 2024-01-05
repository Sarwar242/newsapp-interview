const updateImmunizationModal = "#updateImmunizationModal";
const updateImmunizationForm = "#updateImmunizationForm";
let type = 'status';

function resetReferralFields() {
    $('#notes').css('display', 'unset').val('');
}

window.clickChangeStatusAction = function () {
    resetReferralFields();
    $(updateImmunizationModal).modal('show');
}


window.updateImmunization = function (e, t) {
    e.preventDefault();
    const id = $(updateImmunizationForm).find("input[name='immunization_id']").val();
    let url = BASE_URL + '/members/immunization/' + id + '/status-update-api';
  
    var form_data = $(t).serialize();

    loading('show');
    axios.post(url, form_data)
        .then(response => {
            $(updateImmunizationModal).modal('hide');
            notify(response.data.message, 'success');

            $('#reloadShowDiv').load(' #reloadShowDiv')
        })
        .catch(error => {
            const response = error.response;
            if (response) {
                if (response.status === 422)
                    validationForm(updateImmunizationForm, response.data.errors);
                else
                    notify(response.data.message, 'error');
            }
        })
        .finally(() => {
            loading('hide');
        });
}
