let MemberId = $("#MemberId").val();

let columns = [
    { data: 'id' },
    { data: 'name' },
    { data: 'client_id' },
    { data: 'plan_type' },
    { data: 'services' },
    { data: 'members' },
    { data: 'follow_up_date' },
    { data: 'status' },
    { data: 'operator_id' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive: true
    },
];
let column_defs = [
    { targets: 6, visible: false },
    { "className": "text-center", "targets": '_all' }
];

var table = $('#hauoraPlandataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/members/hauora_plan/" + MemberId,
        data: function (d) {
            d.status = $("#userStatus").val()
        }
    },
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text: '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        { html: colVisibility('#hauoraPlandataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="' + BASE_URL + '/members/hauora_plan/' + MemberId + '/create"><i class="fas fa-plus"></i> Add New</a>' }

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