@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View {{ $customer->fname }} {{ $customer->lname }} Payment History</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Invoice Number</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Amount</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($ToViewIndividualCustomerPaymentHistory as $value)
                        <tr>
                            <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->inovice_number }}</td>
                            <td scope="row" style="font-size: 1.5rem;">${{ $value->amount }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ date('d/ M / Y', strtotime($value->bill_date)); }}</td>
                            <td scope="row" style="font-size: 1.5rem;">
                                @if ( $value->payment_type == 1)
                                    Card
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $ToViewIndividualCustomerPaymentHistory->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

