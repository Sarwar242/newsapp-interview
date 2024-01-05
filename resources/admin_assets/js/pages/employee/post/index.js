let employeeId = $("#employeeId").val();
let columns = [
    {data: 'id'},
    {data: 'title'},
    {data: 'type'},
    {data: 'description'},
    {data: 'sending_date'},
    {data: 'operator_id'},
];
let column_defs = [
    { targets: 2, visible: true },
    { targets: 3, visible: false },
    {"className": "text-center", "targets": [0,2,3,4,5]}
];

var table = $('#postDataTable').DataTable({
    createdRow: function( row, data, dataIndex ) {
        if (data.is_viewed != 1) {
          $(row).attr('style', 'background-color: #f7e47fc9;');
        }
    },
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/employees/" + employeeId + "/posts",
        data: function (d) {
            d.type     = $("#postStatus").val()
            d.emp_id   = employeeId
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

window.filterPostStatus = function (status, type = '') {
    console.log(status);
    $("#postStatus").val(status);
    table.ajax.reload();
}

