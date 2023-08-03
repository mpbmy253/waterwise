@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Active Company</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Company Name or Company UEN" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Company UEN</th>
                        <th scope="col" style="font-size: 1.5rem;">Company Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Payment</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                    @if ($noActiveCompany)
                    <tr>
                        <td colspan="5" style="text-align: center; font-size: 1.5rem;">There is no active company !</td>
                    </tr>
                    @else
                    @php
                        $counter = 0;
                    @endphp
                @foreach ($activeCompany as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="company_uen" scope="row" style="font-size: 1.5rem;">{{ $value->company_uen}}</td>
                        <td class="company_name" scope="row" style="font-size: 1.5rem;">{{ $value->company_name}}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                            @if ($value->payment == 1)
                                PAID
                            @else
                                NOT PAID
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('platformadmin/company/send_email') }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Send Email To Infom their Login Credentials</a>
                            <a href="{{ url('platformadmin/company/suspend_company/' . $value->company_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(!$noActiveCompany)
                <div style="padding: 10px; float: right;">
                    {!! $activeCompany->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
            var company_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchCompany') !!}',
                data: {'search': company_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, company) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="company_uen" style="font-size: 1.5rem;">' + company.company_uen + '</td>';
                            html += '<td class="company_name" style="font-size: 1.5rem;">' + company.company_name + '</td>';
                            html += '<td style="font-size: 1.5rem;">';
                            html += company.payment == 1 ? 'PAID' : 'NOT PAID';
                            html += '</td>';
                            html += '<td>';
                            html += '<a href="{{ url("platformadmin/company/send_email") }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Send Email To Infom their Login Credentials</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("platformadmin/company/suspend_company") }}/' + company.company_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="5" style="text-align: center; font-size: 1.5rem;">There is no such company found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
