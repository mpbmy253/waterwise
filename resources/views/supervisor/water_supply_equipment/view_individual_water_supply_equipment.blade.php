@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Water Supply Equipment: {{ $singleWaterSupplyEquipment->water_supply_equipment_name }} Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantity</label>
                <input class="form-control" type="number" name="water_supply_equipment_qty" value="{{ $singleWaterSupplyEquipment->water_supply_equipment_qty }}" readonly disabled placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Water Supply Equipment Price ($)</label>
                <input class="form-control" type="number" name="water_supply_equipment_price" value="{{ $singleWaterSupplyEquipment->water_supply_equipment_price }}" readonly disabled placeholder="Enter Water Supply Equipment Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Water Supply Equipment Description</label>
                <input class="form-control" type="text" name="water_supply_equipment_description" value="{{ $singleWaterSupplyEquipment->water_supply_equipment_description }}" readonly disabled placeholder="Enter Water Supply Equipment Description" style="font-size: 1.5rem;">
            </div>
        </form>

    </div>
</div>

@endsection
