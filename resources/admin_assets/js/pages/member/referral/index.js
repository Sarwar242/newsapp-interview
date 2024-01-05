let MemberId = $("#MemberId").val();

let columns = [
    { data: 'id' },
    { data: 'refer_from' },
    { data: 'refer_to' },
    { data: 'service' },
    { data: 'parent_name' },
    { data: 'reason' },
    { data: 'status' },
    { data: 'declined_by' },
    { data: 'operator_id' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive: true
    },
];
let column_defs = [
    { targets: 4, visible: false },
    { targets: 7, visible: false },
    { "className": "text-center", "targets": '_all' }
];

var table = $('#referralDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/members/" + MemberId + "/referrals",
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
        { html: colVisibility('#referralDataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="' + BASE_URL + '/members/' + MemberId + '/referrals/create"><i class="fas fa-plus"></i> Add New</a>' }

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
