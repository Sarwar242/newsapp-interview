let MemberId = $("#MemberId").val();
let employeeId = $("#employeeId").val();

let columns = [
    { data: 'id' },
    { data: 'in_time'},
    { data: 'in_time_location'},
    { data: 'out_time'},
    { data: 'out_time_location'},
    { data: 'sign_out_type'},
    { data: 'expected_back_time'},
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
    { targets: 6, visible: true },
    { targets: 7, visible: true },
    {"className": "text-center", "targets": [0,9]}
];

var table = $('#attendanceDataTable').DataTable({
    destroy: true,
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/employees/attendance/" + employeeId,
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
        { html: colVisibility('#attendanceDataTable', column_defs) },
        { html: '<a id="signIn" class="dt-button dt-sign-in"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a>' },
        { html: '<a class="dt-button dt-sign-out" id="signOut" style="display: none; background: #FF4747!important; color: #fff!important; border: none;"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a>' }

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
table.columns.adjust().draw();

executeColVisibility(table);
// End Tables

/**
 * Reset form validation error and old value
 */
function reset() {
  $('#createInForm').trigger("reset");

  $(".in_time").text('');
  $(".out_time").text('');
  $(".sign_out_type").text('');
  $(".expected_back_time").text('');
}

    //let employeeId = $("#employeeId").val();
    let canSignIn = $("#canSignIn").val();
    let editId = null;

    $(document).ready(function() {

        if (canSignIn == 'no') {
          $('#signOut').css("display", "block");
          $('#signIn').css("display", "none");
        }

        $(document).on("click", "#signIn",function() {
          reset();

          $('#signInBody').css("display", "block");
          $('#signOutBody').css("display", "none");

          $('.title-in').css("display", "block");
          $('.title-out').css("display", "none");
          $('.title-edit').css("display", "none");

          $('.btn-in').css("display", "block");
          $('.btn-out').css("display", "none");
          $('.btn-edit').css("display", "none");

          $(signInModal).modal('show');
        });

        $(document).on("click", "#signOut",function() {
          reset();

          $('#signInBody').css("display", "none");
          $('#signOutBody').css("display", "block");

          $('.title-in').css("display", "none");
          $('.title-out').css("display", "block");
          $('.title-edit').css("display", "none");

          $('.btn-in').css("display", "none");
          $('.btn-out').css("display", "block");
          $('.btn-edit').css("display", "none");

          $(signInModal).modal('show');
        });

        $("#sign_out_type").change(function() {
          if ($(this).val() == '') {
              return;
          }

          if ($(this).val() != 'leaving') {
            $('#expected_back_time').css("display", "block");
          } else {
            $('#expected_back_time').css("display", "none");
          }
        });
    });


    window.signIn = function (e, t) {
    e.preventDefault();

    let url = BASE_URL + '/employees/attendance/store/' + employeeId ;

    if (editId) {
      url = BASE_URL + '/employees/attendance/' + editId + '/update';
    }

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
              let errors = response.data.errors;
                if (response.status === 422) {
                  if (errors.in_time) {
                    $(".in_time").text(errors.in_time[0]);
                  }
                  if (errors.out_time) {
                    $(".out_time").text(errors.out_time[0]);
                  }
                  if (errors.sign_out_type) {
                    $(".sign_out_type").text(errors.sign_out_type[0]);
                  }
                  if (errors.expected_back_time) {
                    $(".expected_back_time").text(errors.expected_back_time[0]);
                  }
                } else {
                  notify(response.data.message, 'error');
                }
            }
        })
        .finally(() => {
            loading('hide');
        });
    }

    window.editAttendance = function (id) {
      reset();
      editId = id;
      loading('show');
      axios.get(BASE_URL + '/employees/attendance/' + id + '/show')
      .then(response => {
        let data = response.data.data;

        $('#signInBody').css("display", "block");

        if (data.out_time) {
            $('#signOutBody').css("display", "block");
        }

        $("#in_time").val(data.in_time);
        $("#out_time").val(data.out_time);
        $("#in_time_note").val(data.in_time_note);
        $("#out_time_note").val(data.out_time_note);
        $("#sign_out_type").val(data.sign_out_type);

        if (data.sign_out_type != 'leaving') {
          $("#expected_back_time").css("display", "block");
          $("#expected_back_time2").val(data.expected_back_time);
        }

        $('.title-in').css("display", "none");
        $('.title-out').css("display", "none");
        $('.title-edit').css("display", "block");

        $('.btn-in').css("display", "none");
        $('.btn-out').css("display", "none");
        $('.btn-edit').css("display", "block");

        if (data.delay_time) {
            $('#signOutType').css("display", "none");
            $('#expected_back_time').css("display", "none");
        } else {
            $('#signOutType').css("display", "block");
            $('#expected_back_time').css("display", "block");
        }

        $(signInModal).modal('show');
      })
      .catch(error => {
        if (error.response) {
            notify(response.data.message, 'error');
        }
      })
      .finally(() => {
          loading('hide');
      });
  }
