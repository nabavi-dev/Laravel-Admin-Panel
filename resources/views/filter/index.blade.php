@extends('layouts.backend')

@section('title', 'Filter Product')

@section('content_header', 'Filter Product based on Date Range and Price')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header"></div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="container box">
                            <div class="panel panel-default">
                                <div class="panel-heading">Filter Product Data</div>
                                <div class="panel-body">
                                    <div class="row inner_class">
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <input type="number" name="price" id="price" class="form-control"
                                                       placeholder="Enter Product Price"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="date_filter"
                                                       id="date_filter"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <input type="submit" name="filter_submit"
                                                       class=" btn btn-success btn-sm" value="Filter"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <h3 align="center">Total Data : <span id="total_records"></span></h3>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Feature Image</th>
                                                <th>Product Image</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

    <script type="text/javascript">
        $(function () {
            let dateInterval = getQueryParameter('date_filter');
            let start = moment().startOf('isoWeek');
            let end = moment().endOf('isoWeek');
            if (dateInterval) {
                dateInterval = dateInterval.split(' - ');
                start = dateInterval[0];
                end = dateInterval[1];
            }
            $('#date_filter').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "alwaysShowCalendars": true,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
                }
            });
        });

        function getQueryParameter(name) {
            const url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("body").on('click', '.inner_class', function (e) {
                e.preventDefault();
                let price = $("#price").val();
                let date_filter = $("#date_filter").val();
                let split_data = date_filter.split(" - ");
                let from_date = split_data[0];
                let to_date = split_data[1];
                if (price && date_filter) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('filter.action') }}",
                        method: 'GET',
                        data: {
                            price: price,
                            from_date: from_date,
                            to_date: to_date
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('tbody').html(data.table_data);
                            $('#total_records').text(data.total_data);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    })
                }
            });
        });
    </script>
@endsection
