@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Sellers</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Seller Name or Company Name or Company UEN" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Seller Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Company UEN</th>
                        <th scope="col" style="font-size: 1.5rem;">Company Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Payment</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @php
                    $counter = 0;
                @endphp
                @foreach ($activeSeller as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="seller_name" scope="row" style="font-size: 1.5rem;">{{ $value->fname}} {{ $value->lname}} </td>
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
                            <a href="{{ url('platformadmin/seller/send_email') }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Send Email To Infom their Login Credentials</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $activeSeller->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('keyup', '.search-input', function() {
            var seller_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchSeller') !!}',
                data: {'search': seller_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, seller) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="seller_name" style="font-size: 1.5rem;">' + seller.fname + ' ' + seller.lname + '</td>';
                            html += '<td class="company_uen" style="font-size: 1.5rem;">' + seller.company_uen + '</td>';
                            html += '<td class="company_name" style="font-size: 1.5rem;">' + seller.company_name + '</td>';
                            html += '<td style="font-size: 1.5rem;">';
                            html += seller.payment == 1 ? 'PAID' : 'NOT PAID';
                            html += '</td>';
                            html += '<td>';
                            html += '<a href="{{ url("platformadmin/seller/send_email") }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Send Email To Infom their Login Credentials</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no such seller found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
