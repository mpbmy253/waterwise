@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Edit Water Supply Equipment Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Equipment Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="water_supply_equipment_name" value="{{ old('water_supply_equipment_name', $singleWaterSupplyEquipment->water_supply_equipment_name) }}" required placeholder="Enter Equipment Name" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;">
                    @error('water_supply_equipment_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Quantit <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="water_supply_equipment_qty" value="{{ old('water_supply_equipment_qty', $singleWaterSupplyEquipment->water_supply_equipment_qty) }}" required placeholder="Enter Quantity" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Water Supply Equipment Price ($) <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="water_supply_equipment_price" value="{{ old('water_supply_equipment_price', $singleWaterSupplyEquipment->water_supply_equipment_price) }}" required placeholder="Enter Water Supply Equipment Price" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Water Supply Equipment Description <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="water_supply_equipment_description" value="{{ old('water_supply_equipment_description', $singleWaterSupplyEquipment->water_supply_equipment_description) }}" required placeholder="Enter Water Supply Equipment Description" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Update Water Supply Equipment</button>
        </form>
    </div>
</div>
@endsection
