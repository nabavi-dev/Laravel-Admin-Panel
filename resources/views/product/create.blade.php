@extends('layouts.backend')

@section('title', 'Add Product')

@section('content_header', 'Add Product')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('product.partial.listButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form action="{{url('/product')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="name">Name <sup class="text-danger">*</sup></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                               placeholder="Enter Category Name" class="form-control" id="name">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="category_id">Category <sup class="text-danger">*</sup></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="sub_category_id">Sub-Category <sup
                                                class="text-danger">*</sup></label>
                                        <select class="form-control" name="sub_category_id" id="sub_category_id"
                                                required>
                                            <option value="">Select Sub-Category</option>
                                            @foreach($sub_categories as $sub_cat)
                                                <option
                                                    value="{{$sub_cat->id}}">{{$sub_cat->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="feature_image" class="control-label">Feature Image <sup class="text-danger">*</sup></label>
                                        <input type="file" name="feature_image" class="form-control" id="imgInp"
                                               accept=".jpeg,.png,.jpg,.gif,.svg" required>
                                        <img style="border-radius: 50%;visibility: hidden;" id="blah" src="" alt="Image"
                                             height="80px" width="80px"/>
                                        @error('feature_image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="description">Description <sup class="text-danger">*</sup></label>
                                        <textarea name="description" id="description" cols="10" rows="3"
                                                  placeholder="Enter Description" class="form-control"></textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="price">Price <sup class="text-danger">*</sup></label>
                                        <input type="number" name="price" value="{{ old('price') }}"
                                               placeholder="Enter Order Number" class="form-control" id="price">
                                        @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="product_image">Product Image <sup class="text-danger">*</sup></label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" name="product_image[]" id="product_image" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-sm img_add" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="product_image[]" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger btn-sm img_rmv" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-sm btn-success"> Submit
                                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>

        document.getElementById("imgInp").onclick = function () {
            document.getElementById("blah").style.visibility = "visible";
        };
        function readURL(input) {
            if (input.files && input.files[0]) { var reader = new FileReader();
                reader.onload = function (e) { $('#blah').attr('src', e.target.result); };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function(){ readURL(this); });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

            $(".img_add").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".img_rmv",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>
@endsection
