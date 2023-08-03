
@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Edit Product</h4>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="product_name" value="{{ old('product_name', $singleProductDetails->product_name) }}"  required placeholder="Enter Product Name" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('product_name') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Description</label>
                <input class="form-control" type="text" name="product_description" value="{{ old('product_description', $singleProductDetails->product_description) }}" required placeholder="Enter Product Description" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Price ($)</label>
                <input class="form-control" type="number" name="product_price" value="{{ old('product_price', $singleProductDetails->product_price) }}" required placeholder="Enter Product Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Images</label>
                <div class="producct-img">
                    <img src="{{ asset('public/files/' . $sellerID . '/' . $singleProductDetails->filenames) }}" alt="" style="height: 350px;" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Update Product</button>
        </form>
    </div>
</div>
@endsection

