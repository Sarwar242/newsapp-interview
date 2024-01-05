let MemberId = $("#MemberId").val();
let employeeId = $("#employeeId").val();

let columns = [
    { data: 'id' },
    { data: 'name'},
    { data: 'in_time'},
    { data: 'in_time_location'},
    { data: 'out_time'},
    { data: 'out_time_location'},
    { data: 'type'},
    { data: 'sign_out_type'},
    { data: 'expected_back_time'},
    { data: 'delay'},
    { data: 'visited_to'},
    { data: 'operator_id'},
    { data: 'in_time_note'},
    { data: 'out_time_note'},
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 10, visible: false },
    { targets: 11, visible: false },
    { targets: 12, visible: false },
    { targets: 13, visible: false },
    {"className": "text-center", "targets": [0,9]}
];

var table = $('#alertDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/attendance/alert/",
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
        { html: colVisibility('#alertDataTable', column_defs) },

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


// Stop Alert
let attendanceId = null;

window.showStopAlertModal = function (id) {
    attendanceId = id;
    $("#attendance_id").val(id);
    $(signInModal).modal('show');
}

window.stopAlert = function (e, t) {
    e.preventDefault();

    let url = BASE_URL + '/attendance/' + attendanceId + '/alert-stop';

    const form_data = $(t).serialize();
    loading('show');
    axios.post(url, form_data)
        .then(response => {
            $(signInModal).modal('hide');
            notify(response.data.message, 'success', function (){
                location.reload();
            });
        })
        .catch(error => {
            const response = error.response;
            if (response) {
                notify(response.data.message, 'error');
            }
        })
        .finally(() => {
            loading('hide');
        });
    }
