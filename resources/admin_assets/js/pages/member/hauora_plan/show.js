const updateStatusModal = "#updateStatusModal";
const updateStatusForm = "#updateStatusForm";

window.clickChangeStatusAction = function (id)
{
    console.log(BASE_URL);
    $(updateStatusModal).modal('show');
}

window.updateStatus = function (e, t)
{
    e.preventDefault(BASE_URL);
    const id = $(updateStatusForm).find("input[name='hauora_plan_id']").val();
    const url = BASE_URL + '/members/hauora_plan/' + id + '/update-status';
    var form_data = $(t).serialize();

    loading('show');
    axios.post(url, form_data)
        .then(response => {
            $(updateStatusModal).modal('hide');
            notify(response.data.message, 'success');

            $('#reloadShowDiv').load(' #reloadShowDiv')
        })
        .catch(error => {
            const response = error.response;
            if (response) {
                if (response.status === 422)
                    validationForm(updateStatusForm, response.data.errors);
                else
                    notify(response.data.message, 'error');
            }
        })
        .finally(() => {
            loading('hide');
        });
}

window.goToEdit= function(e, id){
    e.preventDefault();
    e.stopPropagation();
    window.location.href = BASE_URL + '/members/hauora_plan/follow_up/edit/'+id;
}
