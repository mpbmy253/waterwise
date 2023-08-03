@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Equipment: {{ $singleEquipment->equipment_name }} Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}

            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantity</label>
                <input class="form-control" type="number" name="equipment_qty" value="{{ $singleEquipment->equipment_qty }}" readonly disabled placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Equipment Price ($)</label>
                <input class="form-control" type="number" name="equipment_price" value="{{ $singleEquipment->equipment_price }}" readonly disabled placeholder="Enter Equipment Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Installation Date</label>
                <input class="form-control date-picker" name="date" value="{{  date('d / M / Y', strtotime($singleEquipment->installation_date)) }}" readonly disabled placeholder="Enter Installation Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quarantee Period (in Months)</label>
                <input class="form-control" type="number" name="guarantee_period" value="{{ $singleEquipment->guarantee_period }}" readonly disabled placeholder="Enter Quarantee Period" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Replacement Period (in years)</label>
                <input class="form-control" type="number" name="replacement_period" value="{{ $singleEquipment->replacement_period }}" readonly disabled placeholder="Enter Replacement Period" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Flow Rate (in liters per second)</label>
                <input class="form-control" type="number" name="flow_rate" value="{{ $singleEquipment->flow_rate }}" readonly disabled placeholder="Enter Flow Rate" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Power Consumption (in kilowatts (KW))</label>
                <input class="form-control" type="number" name="power_consumption" value="{{ $singleEquipment->power_consumption }}" readonly disabled placeholder="Enter Power Consumption" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Pressure Capacity (in pounds per square inch (PSI))</label>
                <input class="form-control" type="number" name="pressure_capacity" value="{{ $singleEquipment->pressure_capacity }}" readonly disabled placeholder="Enter Pressure Capacity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Votage Requirement (in volts (V))</label>
                <input class="form-control" type="number" name="voltage_requirements" value="{{ $singleEquipment->voltage_requirements }}" readonly disabled placeholder="Enter Votage Requirements" style="font-size: 1.5rem;">
            </div>
        </form>
    </div>
</div>

@endsection
