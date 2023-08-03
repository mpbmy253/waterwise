@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Customer Bills (Void) </h4>
        </div>
        <div class="input-group">
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Amount</th>
                        <th scope="col" style="font-size: 1.5rem;">Bill Date</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                    @php
                        $counter = 0;
                    @endphp
                    @if (is_string($customerVoidBill))
                        <tr>
                            <td colspan="4" style="text-align: center; font-size: 1.5rem;">{{ $customerVoidBill }}</td>
                        </tr>
                    @else
                    @foreach ($customerVoidBill as $value)
                        <tr>
                            <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ $value->amount }}</td>
                            <td scope="row" style="font-size: 1.5rem;">{{ date('d/ M /Y', strtotime($value->bill_date)); }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $customerVoidBill->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
