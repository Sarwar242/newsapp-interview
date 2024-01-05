let MemberId = $("#MemberId").val();

let columns = [
    { data: 'id' },
    { data: 'number_of_member' },
    { data: 'person_18_and_over' },
    { data: 'person_under_18' },
    { data: 'primary_language' },
    { data: 'secondary_language' },
    { data: 'third_language' },
    { data: 'healthy_home_initiative' },
    { data: 'smoker_status' },
    { data: 'pet_in_house' },
    { data: 'number_of_pets' },
    { data: 'type_of_pet' },
    { data: 'operator_id' },
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 5, visible: false },
    { targets: 6, visible: false },
    { targets: 7, visible: false },
    { targets: 8, visible: false },
    { targets: 9, visible: false },
    { targets: 10, visible: false },
    { targets: 12, visible: false },
    {"className": "text-center", "targets": [0,2,3,4]}
];

var clientHouseHoldTable = $('#clientHouseHoldTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/members/house_hold",
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
        { html: colVisibility('#clientHouseHoldTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/members/house_hold/' + MemberId + '/create" ><i class="fas fa-plus"></i> Add New</a>' },
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

executeColVisibility(clientHouseHoldTable);
// End Tables
