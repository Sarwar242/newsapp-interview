let columns = [
    { data: 'id' },
    { data: 'visitor_name' },
    { data: 'visitor_type' },
    { data: 'client_Name' },
    { data: 'ip' },
    { data: 'visiting_time' },
    { data: 'browser' },
];

let column_defs = [
    { targets: 6, visible: false },
    {"className": "text-center", "targets": [0,2,4]}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/advanced/client-profile-visiting-history",
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
