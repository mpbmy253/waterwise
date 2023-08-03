@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Water Supply Equipment (Deleted)</h4>
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Water Supply Equipment Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Water Supply Equipment Price</th>
                        <th scope="col" style="font-size: 1.5rem;">Water Supply Equipment Description</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (is_string($viewDeleteWaterSupplyEquipment))
                    <tr>
                        <td colspan="5" style="text-align: center; font-size: 1.5rem;">{{ $viewDeleteWaterSupplyEquipment }}</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewDeleteWaterSupplyEquipment as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="water_supply_equipment_name" scope="row" style="font-size: 1.5rem;">{{ $value->water_supply_equipment_name }}</td>
                        <td class="water_supply_equipment_price" scope="row" style="font-size: 1.5rem;">${{ $value->water_supply_equipment_price }}</td>
                        <td class="water_supply_equipment_description" scope="row" style="font-size: 1.5rem;">{{ $value->water_supply_equipment_description}}</td>
                        <td>
                            <a href="{{ url('supervisor/water_supply_equipment/restore_water_supply_equipment/' . $value->water_supply_equipment_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Restore</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $viewDeleteWaterSupplyEquipment->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
