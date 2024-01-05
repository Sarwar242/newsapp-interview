@extends('admin.layouts.master')

@section('title', settings('app_title') ? settings('app_title') : 'News-App Dashboard')

@push('styles')
    <style>
        .background-primary {
            background: #4ACE8B !important;
        }

        .card .card-body {
            padding: 0 1.25rem 1.25rem;
        }

        .table td {
            font-size: 0.875rem;
        }

        .table th,
        .table td {
            line-height: 0;
            font-weight: 500;
        }

        .br-15 {
            border-radius: 15px;
        }

        .admin-dashboard-card-design {
            cursor: pointer;
            border-radius: 20px;
            box-shadow: 3px 4px 8px #0d9953d4;
            transition: all 0.5s;
        }

        .admin-dashboard-card-design:hover {
            transform: translateY(-2%);
            box-shadow: 0px 0px 10px #00000099, inset 0px 0px 15px #0d9953;
        }

        .input-group {
            position: relative;
            .date-icon {
                z-index: 3;
                color: #fff;
                top: 0.85rem;
                right: 0.65rem;
                cursor: pointer;
                position: absolute;
            }
        }
        .title-border {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header d-flex justify-content-between">
            <div class="d-block">
                <h4 class="content-title text-blod" style="font-size: 20px; font-weight:900;">DASHBOARD </h4>
            </div>

            <div class="d-flex justify-content-between text-right web-filter-btn">

                <form>
                    <button type="submit" class="btn btn2-secondary mr-2">
                        Default
                    </button>
                </form>

                <form>
                    <button type="submit" class="btn btn2-secondary mr-2">
                        <input type="hidden" name="last_month" value="1">
                        Last Month
                    </button>
                </form>

                <form enctype='multipart/form-data' id='dateForm'>
                    <div class="form-group">
                        <input type="hidden" name="from" value="">
                        <input type="hidden" name="to" value="">
                    </div>
                </form>

                <form>
                    <input type="hidden" id="dateRange" value="0-1">
                    <div class="input-group with-icon">
                        <input type="text" name="date_range" class="form-control" id="date_range" value="" style="border-radius: 8px; background: #4ACE8B; color: white;" />
                        <i class="date-icon fa-solid fa-calendar-days"></i>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between mobile-filter-btn">

                <form>
                    <button type="submit" class="btn btn2-secondary mr-2">
                        Default Value
                    </button>
                </form>

                <form>
                    <button type="submit" class="btn btn2-secondary mr-2">
                        <input type="hidden" name="last_month" value="1">
                        Last Month
                    </button>
                </form>

                <form enctype='multipart/form-data' id='dateForm'>
                    <div class="form-group">
                        <input type="hidden" name="from" value="">
                        <input type="hidden" name="to" value="">
                    </div>
                </form>

                <form>
                    <input type="hidden" id="dateRange" value="">
                    <div class="input-group with-icon d-flex justify-content-between" style="border-radius: 8px; background: #4ACE8B; color: white">
                        <input type="text" name="date_range" class="form-control mobile-filter-date-btn text-white" id="date_range" value=""/>
                        <i class="date-icon fa-solid fa-calendar-days"></i>
                    </div>
                </form>
        </div>

        <div class="row">

            {{-- Member --}}
            <div class="col-lg-3 col-md-3 stretch-card mb-3">
                <div class="card admin-dashboard-card-design mt-2 mb-2">
                    <div class="card-body pt-3">
                        <div class="table-responsive br-15">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center text-white background-primary">
                                        <th colspan="2" style="font-size: 20px; font-weight: bold;">
                                            Members
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- All Charts --}}
        <div class="row">

            <div class="col-lg-4 col-md-4 stretch-card">
                <div class="card admin-dashboard-card-design mt-2 mb-2 ">
                    <div class="client-card-title d-block text-center text-white background-primary pb-3 title-border">
                        <span><b>Articles</b></span>
                    </div>
                    <div style="text-align: center; padding:20%; color:red">
                        <b>No data found!</b>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 stretch-card">
                <div class="card admin-dashboard-card-design mt-2 mb-2">
                    <div class="client-card-title d-block text-center text-white background-primary pb-3 title-border">
                        <span><b>Members</b></span>
                    </div>

                    <div style="text-align: center; padding:20%; color:red">
                        <b>No data found!</b>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 stretch-card">
                <div class="card admin-dashboard-card-design mt-2 mb-2">
                    <div class="client-card-title d-block text-center text-white background-primary pb-3 title-border">
                        <span><b>Visitors</b></span>
                    </div>


                        <div style="text-align: center; padding:20%; color:red">
                            <b>No data found!</b>
                        </div>

                </div>
            </div>

            <!-- <div class="col-lg-12 col-md-12 stretch-card mt-4">
                <div class="card admin-dashboard-card-design mt-2 mb-2">
                    <div class="client-card-title d-block text-center text-white background-primary pb-3 title-border">
                        <span><b>Referral Analytics Chart</b></span>
                    </div>
                    <div id="referralChart" style="width: 100%;"></div>
                </div>
            </div> -->

        </div>

    </div>
@stop

@include('admin.assets.chart')
@include('admin.assets.date-range-picker')


@push('scripts')
    <script type="text/javascript">

        // Start Date Range picker & submit from
        $( document ).ready(function() {
            var dateRange = $("#dateRange").val();
            $('input[name="date_range"]').val(dateRange)
        });

        $(function() {
            $('.date-icon').on('click', function() {
                $('#date_range').focus();
            })

            $('input[name="date_range"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                $('#dateForm').find('input[name="from"]').val(start.format('YYYY-MM-DD'));
                $('#dateForm').find('input[name="to"]').val(end.format('YYYY-MM-DD'));

                $('#dateForm').submit();
            });
        });
        // End Date Range picker

        // Monthly service/referral line charts
        let date =  new Date().getFullYear();

        google.charts.load('current', { 'packages': ['corechart',  'line'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Pending');
            data.addColumn('number', 'Enrolled');
            data.addColumn('number', 'Discharge');
            data.addColumn('number', 'Declined');

            var options = {
                chartArea: {
                    left: 70,
                    right: 170,
                    top: 20,
                    bottom: 70,
                },
                height: 600,
                animation: {
                    startup: true,
                    duration: 2000,
                    easing: 'out',
                },
                curveType: 'function',
                pointSize: 20,
                backgroundColor: 'transparent',

                hAxis: {
                    gridlines: { color: '#0d9953' }
                },
                vAxis: {
                    minValue: 0,
                    gridlines: {
                        color: '#bde4d1',
                    }
                },
                series: {
                    0: {
                        color: '#ff9900',
                        pointShape: 'circle'
                    },
                    1: {
                        color: '#109618',
                        pointShape: 'square'
                    },
                    2: {
                        color: '#3366cc',
                        pointShape: 'diamond'
                    },
                    3: {
                        color: '#dc3912',
                        pointShape: 'polygon'
                    },
                },
            };

            var chart = new google.visualization.LineChart(document.getElementById('referralChart'));
            chart.draw(data, options);
        }
    </script>
@endpush
