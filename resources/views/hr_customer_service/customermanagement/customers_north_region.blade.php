@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customers in North Region</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Customer Name">
        </div>
    </div>
    <div class="input-group">
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('hr_customer_service/customermanagement/view_customer_north_region')}}" class="btn btn-sm btn-block btn-info">North</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('hr_customer_service/customermanagement/view_customer_south_region')}}" class="btn btn-sm btn-block btn-info">South</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('hr_customer_service/customermanagement/view_customer_east_region')}}" class="btn btn-sm btn-block btn-info">East</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('hr_customer_service/customermanagement/view_customer_west_region')}}" class="btn btn-sm btn-block btn-info">West</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('hr_customer_service/customermanagement/view_customer_by_region')}}" class="btn btn-sm btn-block btn-info">All</a>
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Region</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noCustomerInNorthRegion)
                    <tr>
                        <td colspan="6" style="text-align: center;">There is no Customer under North region!</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewCustomerNorthRegion as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="customer_name" scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td class="region" scope="row" style="font-size: 1.5rem;">{{ $value->region }}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noCustomerInNorthRegion )
                <div style="padding: 10px; float: right;">
                    {!! $viewCustomerNorthRegion->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                url: '{!! URL::to('autoSearchCustomerNorthRegionHR') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td class="customer_name">' + customer.fname + ' ' + customer.lname +'</td>';
                            html += '<td class="region">' + customer.region + '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="4" style="text-align: center;">There is no customer found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
