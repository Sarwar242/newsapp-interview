let columns = [
    { data: 'id' },
    { data: 'name' },
    { data: 'service_manager_id' },
    { data: 'start_date' },
    { data: 'end_date' },
    { data: 'location' },
    { data: 'reporting_frequency' },
    { data: 'funder_name' },
    { data: 'action', name: 'action', orderable: false, searchable: false, responsive:true },
];

let column_defs = [
    // { targets: 4, visible: false },
    {"className": "text-center", "targets": [0, 6]}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/configs/more-settings/services",
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
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/configs/more-settings/services/create"><i class="fas fa-plus"></i> Add New</a>' }
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

