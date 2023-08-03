@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customers Bank </h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Customer Name">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Bank Name</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noCustomerPaidUsingBank)
                    <tr>
                        <td colspan="6" style="text-align: center;">There is no customer paying using bank !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewCustomersWithBankDetails as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="customer_name" scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td class="bank_name" scope="row" style="font-size: 1.5rem;">{{ $value->bank_name }}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noCustomerPaidUsingBank )
                <div style="padding: 10px; float: right;">
                    {!! $viewCustomersWithBankDetails->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                url: '{!! URL::to('autoSearchCustomerBank') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td class="customer_name">' + customer.fname + ' ' + customer.lname +'</td>';
                            html += '<td class="bank_name">' + customer.bank_name + '</td>';
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
