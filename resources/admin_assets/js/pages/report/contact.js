let columns = [
    { data: 'id' },
    { data: 'name' },
    { data: 'email' },
    { data: 'phone' },
    { data: 'user_type' },
    { data: 'status' },
    { data: 'location' },
    { data: 'client_id' },
    { data: 'employee_id' },
    { data: 'e_name' },
    { data: 'e_email' },
    { data: 'e_phone' },
    { data: 'e_relationship' },
    { data: 'e_address' },
    { data: 'operator' },
];
let column_defs = [
    { targets: 7, visible: false },
    { targets: 8, visible: false },
    { targets: 12, visible: false },
    { targets: 13, visible: false },
    { targets: 14, visible: false },

    { "className": "text-center", "targets": [0,5] }
];

var table = $('#contactReportDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/report/emergency-contacts",
        data: function (d) {
            d.type   = $("#type").val()
            d.location = $("#location").val()
            d.status = $("#status").val()
            d.fromDate = $("#fromDate").val()
            d.toDate = $("#toDate").val()
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
        { html: colVisibility('#contactReportDataTable', column_defs) },

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

$(document).ready(function () {
    $('#type').select2({
        placeholder: "Select User Type",
        allowClear: true
    });

    $('#location').select2({
        placeholder: "Select Location",
        allowClear: true
    });

    $('#status').select2({
        placeholder: "Select Status",
        allowClear: true
    });
});

window.filterUsers = function () {
    table.ajax.reload();
}

$(function() {
    $('.date-icon').on('click', function() {
        $('#date_range').focus();
    })

    $('input[name="date_range"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        $('#fromDate').val(start.format('YYYY-MM-DD'));
        $('#toDate').val(end.format('YYYY-MM-DD'));
    });
});

window.filterClear = function () {
    $('#type').val([]).trigger('change');
    $('#location').val([]).trigger('change');
    $('#status').val([]).trigger('change');
    $('input[name="date_range"]').val([]);

    table.ajax.reload();
}
