@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customer Payment History </h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Customer Name" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Previous Bill Amount</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                    @if ($noCustomerPaidBills)
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 1.5rem;">There is no paid bills of Customer !</td>
                    </tr>
                    @else
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($customerPaidBills as $value)
                        <tr>
                            <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->amount }}</td>
                            <td>
                                @if ( $value->bill_status == 1)
                                <a href="{{ url('hr_customer_service/customerpayment/view_individual_customer_payment_history/' . $value->user_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Payment History</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(!$noCustomerPaidBills )
                <div style="padding: 10px; float: right;">
                    {!! $customerPaidBills->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                url: '{!! URL::to('autoSearchCustomerPaidBill') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="customer_name" style="font-size: 1.5rem;">' + customer.fname + ' ' + customer.lname +'</td>';
                            html += '<td class="latest_bill_amount" style="font-size: 1.5rem;">' + customer.amount + '</td>';
                            html += '<td>';
                            html += '<a href="{{ url("hr_customer_service/customerpayment/view_individual_customer_payment_history") }}/' + customer.user_id + '" class="btn btn-sm btn-primary"  style="font-size: 1.5rem;">View Payment History</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="4" style="text-align: center; font-size: 1.5rem;">There is no such Customer found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
