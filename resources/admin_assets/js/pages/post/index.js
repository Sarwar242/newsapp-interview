let columns = [
    {data: 'id'},
    {data: 'title'},
    {data: 'category_id'},
    {data: 'created_at'},
    {data: 'author_id'},
    {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
];
let column_defs = [
    {"className": "text-center", "targets": [0,2,3,4]}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/panel/articles",
        data: function (d) {
            d.type     = $("#postStatus").val()
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
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/panel/news/create"><i class="fas fa-plus"></i> Add New</a>' }
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

window.filterStatus = function (status, type = '') {
    console.log(status);
    $("#postStatus").val(status);
    table.ajax.reload();
}

window.changeStatus = function (e, route)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', 'Are you sure Update Status. ');
    table.ajax.reload();
}
