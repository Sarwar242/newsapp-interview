let columns = [
    { data: 'id' },
    { data: 'name' },
    { data: 'nhi' },
    { data: 'phone' },
    { data: 'alert' },
    { data: 'client_id' },
    { data: 'operator_id' },
    { data: 'operator_name' },
];
let column_defs = [
    { targets: 1, visible: true },
    { "className": "text-center", "targets": [0,5,6] }
];

var table = $('#alertsReportDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/report/alerts",
        data: function (d) {
            d.alertIds   = $("#alert").val()
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
        { html: colVisibility('#alertsReportDataTable', column_defs) },

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
    $('#alert').select2({
        placeholder: "Select Alert",
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
    $('#alert').val([]).trigger('change');
    $('input[name="date_range"]').val([]);

    table.ajax.reload();
}
