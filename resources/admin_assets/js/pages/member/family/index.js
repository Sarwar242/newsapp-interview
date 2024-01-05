let UserId = $("#UserId").val();

let columns = [
    { data: 'id' },
    { data: 'family_id' },
    { data: 'related_client_id' },
    { data: 'operator_id' },
    { data: 'note' },
    { data: 'created_at' },
];
let column_defs = [
    { targets: 4, visible: true },
    {"className": "text-center", "targets": [0,1,2,3,4]}
];

var clientFamilyTable = $('#clientFamilyTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + '/members/family/' + UserId,
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
        { html: colVisibility('#clientFamilyTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="#" onclick="addFamilyMember()"><i class="fas fa-plus"></i> Add New</a>' },
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

executeColVisibility(clientFamilyTable);
// End Tables

const addNewFamilyMember = "#addNewFamilyMember";
window.addFamilyMember = function ()
{
    loading('show');

    $(addNewFamilyMember).modal('show');

    loading('hide');
}
