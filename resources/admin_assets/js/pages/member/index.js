let columns = [
    { data: 'id' },
    { data: 'first_name' },
    { data: 'last_name' },
    { data: 'email' },
    { data: 'phone' },
];
let column_defs = [
    { targets: 4, visible: true },
    {"className": "text-center", "targets": []}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/users",
    },
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text : '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        { html: colVisibility('#dataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/users/create"><i class="fas fa-plus"></i> Add New</a>' }
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: {
            pageLength: {
                _: "%d rows",
            }
        }
    }
});

executeColVisibility(table);
// End Tables

window.filterStatus = function (status, type = '')
{
    if(type == 'is_deleted')
    {
        $("#isDeleted").val(1);
    }
    else{
        $("#memberStatus").val(status);
        $("#isDeleted").val(0);
    }
    table.ajax.reload();
}

window.restoreMember = function (id)
{
    loading('show');

    axios.post(BASE_URL + '/users/' + id + '/restore-api')
        .then(response => {
            notify(response.data.message, 'success');
            table.ajax.reload();
        })
        .catch(error => {
            const response = error.response;
            if (response)
                notify(response.data.message, 'error');
        })
        .finally(() => {
            loading('hide');
        });
}
