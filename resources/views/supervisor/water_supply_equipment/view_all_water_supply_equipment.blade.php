@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Water Supply Equipment (Available)</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Water Supply Equipment Name" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
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
                <tbody class="fill_data">
                @if ($noActiveWaterSupplyEquipment)
                    <tr>
                        <td colspan="5" style="text-align: center; font-size: 1.5rem;">There is no Water Supply Equipment found !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewActiveWaterSupplyEquipment as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="water_supply_equipment_name" scope="row" style="font-size: 1.5rem;">{{ $value->water_supply_equipment_name }}</td>
                        <td class="water_supply_equipment_price" scope="row" style="font-size: 1.5rem;">${{ $value->water_supply_equipment_price }}</td>
                        <td class="water_supply_equipment_description" scope="row" style="font-size: 1.5rem;">{{ $value->water_supply_equipment_description}} mg/L</td>
                        <td>
                            <a href="{{ url('supervisor/water_supply_equipment/view_individual_water_supply_equipment/'. $value->water_supply_equipment_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>
                            <a href="{{ url('supervisor/water_supply_equipment/edit_water_supply_equipment/' . $value->water_supply_equipment_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                            <a href="{{ url('supervisor/water_supply_equipment/delete_water_supply_equipment/' . $value->water_supply_equipment_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                            <a href="{{ url('supervisor/water_supply_equipment/suspend_water_supply_equipment/' . $value->water_supply_equipment_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noActiveWaterSupplyEquipment)
                <div style="padding: 10px; float: right;">
                    {!! $viewActiveWaterSupplyEquipment->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('keyup', '.search-input', function() {
            var water_equipment_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchWaterSupplyEquipment') !!}',
                data: {'search': water_equipment_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, waterEquipment) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="water_supply_equipment_name" style="font-size: 1.5rem;">' + waterEquipment.water_supply_equipment_name + '</td>';
                            html += '<td class="water_supply_equipment_price" style="font-size: 1.5rem;">$' + waterEquipment.water_supply_equipment_price + '</td>';
                            html += '<td class="water_supply_equipment_description" style="font-size: 1.5rem;">' + waterEquipment.water_supply_equipment_description + ' mg/L</td>';
                            html += '<td>';
                            html += '<a href="{{ url("supervisor/water_supply_equipment/view_individual_water_supply_equipment/") }}/' + waterEquipment.water_supply_equipment_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/water_supply_equipment/edit_water_supply_equipment/") }}/' + waterEquipment.water_supply_equipment_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/water_supply_equipment/delete_water_supply_equipment/") }}/' + waterEquipment.water_supply_equipment_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/water_supply_equipment/suspend_water_supply_equipment/") }}/' + waterEquipment.water_supply_equipment_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="5" style="text-align: center; font-size: 1.5rem;">There is no Water Supply Equipment found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
