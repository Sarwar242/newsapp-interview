let columns = [
    { data: 'id' },
    { data: 'service_id' },
    { data: 'client_id' },
    { data: 'refer_from' },
    { data: 'refer_to' },
    { data: 'reason' },
    { data: 'created_at' },
    { data: 'status' },
    { data: 'action_count' },
    { data: 'initial_action_time' },
    { data: 'total_time' },
    { data: 'operator' },
];
let column_defs = [
    { targets: 5, visible: false },
    { targets: 11, visible: false },
    { "className": "text-center", "targets": [0, 7, 8] }
];

var table = $('#referralListReportDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/report/referral-list",
        data: function (d) {
            d.actionCount   = $("#actionCount").val()
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
        { html: colVisibility('#referralListReportDataTable', column_defs) },

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

window.filterReferralList = function () {
    table.ajax.reload();
}

$(document).ready(function () {
    $('#referral').select2({
        placeholder: "Select Referral",
        allowClear: true
    });
});

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
    $('#actionCount').val('');
    $('input[name="date_range"]').val([]);

    table.ajax.reload();
}
