@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customer Billing</h4>
        </div>
        <form action="" method="" class="mb-5">
            <div class="input-group">
                <input type="text" class="form-control search-input" name="name" placeholder="Search Customer Name" style="font-size: 1.5rem;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Latest Bill Amount</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Status</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_string($ToGetCustomerDetailsAndLatestBillAmount))
                        <tr>
                            <td colspan="7" style="text-align: center; font-size: 1.5rem;">{{ $ToGetCustomerDetailsAndLatestBillAmount }}</td>
                        </tr>
                    @else
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($ToGetCustomerDetailsAndLatestBillAmount as $value)
                        <tr>
                            <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->amount }}</td>
                            <td scope="row" style="font-size: 1.5rem;">
                                @if ( $value->bill_status == 1)
                                    Paid
                                @else
                                    Not Paid
                                @endif
                            </td>
                            <td scope="row">
                                <a href="{{ url('hr_customer_service/customerbilling/view_payment_history/'. $value->user_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Payment History</a>
                                @if ( $value->bill_status == 2)
                                    <a href="{{ url('hr_customer_service/customerbilling/send_bill_alert') }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Send Notification Bill Alert</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $ToGetCustomerDetailsAndLatestBillAmount->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

