@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Add New Product</h4>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="product_name" value="{{ old('product_name') }}" required placeholder="Enter Product Name" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('product_name') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Description <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="product_description" value="{{ old('product_description') }}" required placeholder="Enter Product Description" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Price ($)<span style="color:red;">*</span></label>
                <input class="form-control" type="number" step="0.01" name="product_price" value="{{ old('product_price') }}" required placeholder="Enter Product Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Images <span style="color:red;">*</span></label>
                <div class="input-group">
                    <input type="file" name="filenames" class="myfrm form-control" style="font-size: 1.25rem;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Add New Product</button>
        </form>
    </div>
</div>
@endsection

