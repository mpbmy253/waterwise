@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customers Meter Readings</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Customer Name" style="font-size: 1.5rem;">
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Total Usage</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noCustomerMeterReading)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no Customer !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewCustomerMeterReading as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="customer_name" scope="row" style="font-size: 1.5rem;">{{ $value->customer_name }}</td>
                        <td class="total_meter_value" scope="row" style="font-size: 1.5rem;">{{ $value->total_meter_value }} cu M</td>
                        <td>
                            <a href="{{ url('technician/meterreading/view_individual_customer_meter_reading/'. $value->customer_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View More</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noCustomerMeterReading )
                <div style="padding: 10px; float: right;">
                    {!! $viewCustomerMeterReading->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
            var customer_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchCustomerMeterTechnician') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="customer_name" style="font-size: 1.5rem;">' + customer.customer_name + '</td>';
                            html += '<td class="total_meter_value" style="font-size: 1.5rem;">' + customer.total_meter_value + ' cu M</td>';
                            html += '<td>';
                            html += '<a href="{{ url("technician/meterreading/view_individual_customer_meter_reading") }}/' + customer.customer_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View More</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="4" style="text-align: center; font-size: 1.5rem;">There is no customer found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection

