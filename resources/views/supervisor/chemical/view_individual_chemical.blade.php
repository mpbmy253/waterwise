@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Chemical: {{ $singleChemical->chemical_name }} Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantity</label>
                <input class="form-control" type="number" name="chemical_qty" value="{{ $singleChemical->chemical_qty }}" readonly disabled placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Chemical Price ($)</label>
                <input class="form-control" type="number" name="chemical_price" value="{{ $singleChemical->chemical_price }}" readonly disabled placeholder="Enter Chemical Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Using Time (in mins)</label>
                <input class="form-control" type="number" name="using_time" value="{{ $singleChemical->using_time }}" readonly disabled placeholder="Enter Using Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Chemical Level (mg/L)</label>
                <input class="form-control" type="number" name="chemical_level" value="{{ $singleChemical->chemical_level }}" readonly disabled placeholder="Enter Chemical Level" style="font-size: 1.5rem;">
            </div>
        </form>
    </div>
</div>

@endsection
