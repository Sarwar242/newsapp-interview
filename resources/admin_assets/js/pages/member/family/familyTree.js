let columns = [
    { data: 'id' },
    { data: 'family_id' },
    { data: 'related_client_id' },
    { data: 'operator_id' },
    { data: 'note' },
    { data: 'created_at' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];

let column_defs = [
    { targets: 4, visible: true },
    {"className": "text-center", "targets": [0,1,3]}
];

var table = $('#dataTable').DataTable({
    order: [[1, 'ASC']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/clients/family",
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
