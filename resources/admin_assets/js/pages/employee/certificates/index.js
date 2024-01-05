let employeeId = $("#employeeId").val();

let columns = [
    { data: 'id' },
    { data: 'type' },
    { data: 'facilitator' },
    { data: 'training_place' },
    { data: 'score' },
    { data: 'cost' },
    { data: 'compilation_date' },
    { data: 'expire_date' },
    { data: 'documents' },
    { data: 'operator_id' },
    { data: 'created_at' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 7, visible: true },
    { targets: 9, visible: true },
    { targets: 10, visible: false },
    {"className": "text-center", "targets": [0,4,5,6,7]}
];

var certificatesTable = $('#certificatesTable').DataTable({
    destroy: true,
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/employees/" +employeeId+ "/certificates",
    },
    columns: columns,
    dom: 'Bfrtip',
    "bFilter": true,
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
        { html: colVisibility('#certificatesTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/employees/'+ employeeId +'/certificates/create"><i class="fas fa-plus"></i> Add New</a>' },
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
certificatesTable.columns.adjust().draw();

executeColVisibility(certificatesTable);
// End Tables
