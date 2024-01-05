
let postId = $("#postId").val();
let columns = [
    {data: 'id'},
    {data: 'user_id'},
    {data: 'email'},
    {data: 'send_status'},
    {data: 'sent_at'},
    {data: 'is_passed'},
    {data: 'is_viewed'},
    {data: 'action'},
];
let column_defs = [
    {"className": "text-center", "targets": [0,2,3,4,5,6,7]}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'asc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/posts/" + postId + "/show",
        data: function (d) {
        }
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

window.resendEmail = function (id)
{
    loading('show');
    const url = BASE_URL + '/posts/' + id + '/resend-api';
    axios.post(url)
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

