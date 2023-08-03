@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Servicing Request From Customer</h4>
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
                        <th scope="col" style="font-size: 1.5rem;">Servicing Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if ($noServiceRequest)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no Servicing !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($ToGetAllServiceRequest as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d/ M / Y', strtotime($value->service_date)); }}</td>
                        <td>
                        @if ($value->service_service_status == 0)
                            <a href="{{ url('hr_customer_service/customerinteraction/view_service_request/'. $value->service_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Service Request</a>
                        @endif
                            <a href="{{ url('hr_customer_service/customerinteraction/sent_technician_over/'. $value->service_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Send Technician Over</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noServiceRequest )
                <div style="padding: 10px; float: right;">
                    {!! $ToGetAllServiceRequest->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

