@extends('layouts.backend')

@section('title', 'List of Products')

@section('content_header', 'List of Products')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('product.partial.addButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <table id="list-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Feature Image</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(!empty($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->sub_category->sub_category_name }}</td>
                                        <td>
                                            <img style="border-radius: 50%;" id="blah"
                                                 src="{{asset('storage/feature_image/'.$product->feature_image)}}"
                                                 alt="Feature Image"
                                                 height="40px" width="40px"/>
                                        </td>
                                        <td>
                                            @foreach(json_decode($product->product_image, true) as $value)
                                                <img style="border-radius: 50%;" id="blah"
                                                     src="{{asset('product_image/'.$value)}}"
                                                     alt="Feature Image"
                                                     height="40px" width="40px"/>
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="{{url('/product', ['id'=>$product->id])}}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')"
                                                  style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-xs">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        jQuery(function ($) {

            let table = $('#list-table').DataTable({
                "responsive": true,
                "pageLength": 50
            });

            // Sort by datatable desc
            table.order([0, 'asc'])
                .draw();

        })
    </script>
@endsection
