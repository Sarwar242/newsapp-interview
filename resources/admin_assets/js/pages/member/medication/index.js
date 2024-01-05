let MemberId = $("#MemberId").val();

let columns = [
    { data: 'id' },
    { data: 'follow_up_date' },
    { data: 'operator_id' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 2, visible: true },
    {"className": "text-center", "targets": [0,1,2,3]}
];

var table = $('#medicationTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/members/medication/" + MemberId,
        data: function (d) {
                d.status    = $("#userStatus").val()
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
        { html: colVisibility('#medicationTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/members/medication/' + MemberId + '/create"><i class="fas fa-plus"></i> Add New</a>' }

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