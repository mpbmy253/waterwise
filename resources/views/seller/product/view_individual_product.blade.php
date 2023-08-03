@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Product</h4>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="" action="" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Name</label>
                <input class="form-control" type="text" name="product_name" value="{{ $singleProductDetails->product_name }}" readonly placeholder="Enter Product Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Description</label>
                <input class="form-control" type="text" name="product_description" value="{{ $singleProductDetails->product_description }}" readonly placeholder="Enter Product Description" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Price ($)</label>
                <input class="form-control" type="number" name="product_price" value="{{ $singleProductDetails->product_price }}" readonly placeholder="Enter Product Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Product Images</label>
                <div class="producct-img">
                    <img src="{{ asset('files' . '/' . $singleProductDetails->filenames) }}" alt="" style="height: 350px;">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
