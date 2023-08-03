@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Create New Equipment</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Equipment Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="equipment_name" value="{{ old('equipment_name') }}" required placeholder="Enter Equipment Name" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;">
                    @error('equipment_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantity <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="equipment_qty" value="{{ old('equipment_qty') }}" required placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Equipment Price ($) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" step="0.01" name="equipment_price" value="{{ old('equipment_price') }}" required placeholder="Enter Equipment Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Installation Date <span style="color:red;">*</span></label>
                <input class="form-control date-picker" name="date" value="{{ old('date') }}" required placeholder="Enter Installation Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quarantee Period (in Months) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="guarantee_period" value="{{ old('guarantee_period') }}" required placeholder="Enter Quarantee Period" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Replacement Period (in years) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="replacement_period" value="{{ old('replacement_period') }}" required placeholder="Enter Replacement Period" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Flow Rate (in liters per second) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" step="0.01" name="flow_rate" value="{{ old('flow_rate') }}" required placeholder="Enter Flow Rate" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Power Consumption (in kilowatts (KW)) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" step="0.01" name="power_consumption" value="{{ old('power_consumption') }}" required placeholder="Enter Power Consumption" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Pressure Capacity (in pounds per square inch (PSI)) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" step="0.01" name="pressure_capacity" value="{{ old('pressure_capacity') }}" required placeholder="Enter Pressure Capacity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Voltage Requirement (in volts (V)) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="voltage_requirements" value="{{ old('voltage_requirements') }}" required placeholder="Enter Votage Requirements" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Add New Equipment</button>
        </form>
    </div>
</div>
@endsection
