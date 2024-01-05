let MemberId = $("#MemberId").val();

let columns = [
    { data: 'id' },
    { data: 'employee_id' },
    { data: 'category'},
    { data: 'contact_type' },
    { data: 'date_time' },
    { data: 'title' },
    { data: 'description' },
    { data: 'contact_person' },
    { data: 'is_group_session' },
    { data: 'number_of_attendance' },
    { data: 'operator_id' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 7, visible: false },
    { targets: 8, visible: false },
    {"className": "text-center", "targets": [0,3,6,8,7,9]}
];

var prescriptionDataTable = $('#prescriptionDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/members/prescriptions"
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
        { html: colVisibility('#prescriptionDataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/members/prescriptions/' + MemberId + '/create"><i class="fas fa-plus"></i> Add New</a>' }

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

executeColVisibility(prescriptionDataTable);
// End Tables