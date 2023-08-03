@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customer Bills (Not-Paid) </h4>
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
                        <th scope="col" style="font-size: 1.5rem;">Bill Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Latest Bill Amount</th>
                        <th scope="col" style="font-size: 1.5rem;">Months Due</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Status</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                    @if ($noCustomerPendingBills)
                    <tr>
                        <td colspan="7" style="text-align: center; font-size: 1.5rem;">There is no pending bills of Customer !</td>
                    </tr>
                    @else
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($customerPendingBills as $value)
                        <tr>
                            <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ date('d/ M /Y', strtotime($value->bill_date)); }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->amount }}</td>
                            <td scope="row" style="font-size: 1.5rem;">
                                @if($value->amount >100)
                                {{ rand(2, 3) }}
                                @else
                                1
                                @endif
                            </td>
                            <td scope="row" style="font-size: 1.5rem;">
                                @if ( $value->bill_status == 2)
                                    NOT PAID
                                @endif
                            </td>
                            <td>
                                @if ( $value->bill_status == 2)
                                    <a href="{{ url('hr_customer_service/customerbilling/void_bills/' . $value->customer_bill_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Void Bill</a>
                                    <a href="{{ url('hr_customer_service/customerbilling/send_bill_alert/' . $value->customer_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Send Notification Bill Alert</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(!$noCustomerPendingBills )
                <div style="padding: 10px; float: right;">
                    {!! $customerPendingBills->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Generate a random number between 1 and 3 for all rows initially
        $('.fill_data td:nth-child(4)').text(function() {
            return $(this).text() || Math.floor(Math.random() * 3) + 1;
        });
        $(document).on('keyup', '.search-input', function() {
            var customer_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchCustomerPendingBill') !!}',
                data: {'search': customer_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, customer) {
                            var monthsDue = $('.fill_data td:nth-child(4)').text(); // Get the initial value of "Months Due"
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="customer_name" style="font-size: 1.5rem;">' + customer.fname + ' ' + customer.lname +'</td>';
                            html += '<td class="date" style="font-size: 1.5rem;">' + formatDate(customer.bill_date) + '</td>';
                            html += '<td class="latest_bill_amount" style="font-size: 1.5rem;">' + customer.amount + '</td>';
                            html += '<td style="font-size: 1.5rem;">';
                            html += customer.amount > 100 ? Math.floor(Math.random() * 2) + 1 : 1;
                            html += '</td>';
                            html += '<td style="font-size: 1.5rem;">';
                            html += customer.payment == 1 ? 'PAID' : 'NOT PAID';
                            html += '</td>';
                            html += '<td>';
                            html += '<a href="{{ url("hr_customer_service/customerbilling/void_bills") }}/' + customer.customer_bill_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Void Bills</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("hr_customer_service/customerbilling/send_bill_alert") }}/' + customer.customer_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Send Notification Alert</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="7" style="text-align: center; font-size: 1.5rem;">There is no such Customer found !</td>';
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
