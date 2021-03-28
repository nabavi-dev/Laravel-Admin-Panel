@extends('layouts.backend')

@section('title', 'Live Search')

@section('content_header', 'Live Search Based On Product Name, Category and Sub-Category')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header"></div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="container box">
                        <h3 align="center">Live Search Based On Product Name, Category and Sub-Category</h3><br/>
                        <div class="panel panel-default">
                            <div class="panel-heading">Search Product Data</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Product Data" />
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
    <script>
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query = '')
            {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{ route('live_search.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                let query = $(this).val();
                fetch_customer_data(query);
            });
        });
    </script>
@endsection
