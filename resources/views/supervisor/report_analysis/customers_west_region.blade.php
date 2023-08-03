@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customers in West Region</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Customer Name" style="font-size: 1.5rem;">
        </div>
    </div>
    <div class="input-group">
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('supervisor/report_analysis/view_customer_north_region')}}" class="btn btn-sm btn-block btn-info" style="font-size: 1.5rem;">North</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('supervisor/report_analysis/view_customer_south_region')}}" class="btn btn-sm btn-block btn-info" style="font-size: 1.5rem;">South</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('supervisor/report_analysis/view_customer_east_region')}}" class="btn btn-sm btn-block btn-info" style="font-size: 1.5rem;">East</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('supervisor/report_analysis/view_customer_west_region')}}" class="btn btn-sm btn-block btn-info" style="font-size: 1.5rem;">West</a>
        </div>
        <div class="col-md-2 d-flex justify-content-between">
            <a href="{{url('supervisor/report_analysis/view_customer_by_region')}}" class="btn btn-sm btn-block btn-info" style="font-size: 1.5rem;">All</a>
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
                @if ($noCustomerInWestRegion)
                    <tr>
                        <td colspan="6" style="text-align: center;">There is no Customer under West region!</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewCustomerWestRegion as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="customer_name" scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td class="region" scope="row" style="font-size: 1.5rem;">{{ $value->region }}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noCustomerInWestRegion )
                <div style="padding: 10px; float: right;">
                    {!! $viewCustomerWestRegion->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                url: '{!! URL::to('autoSearchCustomerWestRegionSupervisor') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="customer_name" style="font-size: 1.5rem;">' + customer.fname + ' ' + customer.lname +'</td>';
                            html += '<td class="region" style="font-size: 1.5rem;">' + customer.region + '</td>';
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
