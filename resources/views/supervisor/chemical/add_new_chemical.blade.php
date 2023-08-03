@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Create New Chemical</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Chemical Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="chemical_name" value="{{ old('chemical_name') }}" required placeholder="Enter Chemical Name" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;">
                    @error('chemical_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantity <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="chemical_qty" value="{{ old('chemical_qty') }}" required placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Chemical Price ($) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="chemical_price" value="{{ old('chemical_price') }}" required placeholder="Enter Chemical Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Using Time (in mins) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="using_time" value="{{ old('using_time') }}" required placeholder="Enter Using Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Chemical Level (mg/L) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="chemical_level" value="{{ old('chemical_level') }}" required placeholder="Enter Chemical Level" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Add New Chemical</button>
        </form>
    </div>
</div>
@endsection
