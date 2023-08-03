@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Equipment (Available)</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Equipment Name" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Equipment Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Equipment Price</th>
                        <th scope="col" style="font-size: 1.5rem;">Installation Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Guarantee Period</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                    @if (is_string($viewActiveEquipment))
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no equipment found !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewActiveEquipment as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="equipment_name" scope="row" style="font-size: 1.5rem;">{{ $value->equipment_name }}</td>
                        <td class="equipment_price" scope="row" style="font-size: 1.5rem;">${{ $value->equipment_price }}</td>
                        <td class="installation_date" scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->installation_date)); }}</td>
                        <td class="guarantee_period" scope="row" style="font-size: 1.5rem;">{{ $value->guarantee_period}} months</td>
                        <td>
                            <a href="{{ url('supervisor/equipment/view_individual_equipment/'. $value->equipment_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>
                            <a href="{{ url('supervisor/equipment/edit_equipment/' . $value->equipment_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                            <a href="{{ url('supervisor/equipment/delete_equipment/' . $value->equipment_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                            <a href="{{ url('supervisor/equipment/suspend_equipment/' . $value->equipment_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$viewActiveEquipment )
                <div style="padding: 10px; float: right;">
                    {!! $viewActiveEquipment->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
            var equipment_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchEquipments') !!}',
                data: {'search': equipment_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, equipment) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.125rem;">' + (index + 1) + '</td>';
                            html += '<td class="equipment_name" style="font-size: 1.5rem;">' + equipment.equipment_name + '</td>';
                            html += '<td class="equipment_price" style="font-size: 1.5rem;">$' + equipment.equipment_price + '</td>';
                            html += '<td class="installation_date" style="font-size: 1.5rem;">' + formatDate(equipment.installation_date) + '</td>';
                            html += '<td class="guarantee_period" style="font-size: 1.5rem;">' + equipment.guarantee_period + ' months</td>';
                            html += '<td>';
                            html += '<a href="{{ url("supervisor/equipment/view_individual_equipment/") }}/' + equipment.equipment_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/equipment/edit_equipment/") }}/' + equipment.equipment_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/equipment/delete_equipment/") }}/' + equipment.equipment_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/equipment/suspend_equipment/") }}/' + equipment.equipment_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no equipment found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });

    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = ("0" + date.getDate()).slice(-2); // Add leading zero if day is a single digit
        var month = date.toLocaleString('default', { month: 'short' });
        var year = date.getFullYear();
        return day + '/ ' + month + ' /' + year;
    }
</script>
@endsection
