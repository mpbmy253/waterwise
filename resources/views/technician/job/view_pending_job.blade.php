@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Pending Jobs</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Start Time</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($noPendingJobForTechnician)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no jobs for you !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewPendingJobForTechnician as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->job_date)) }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->job_start_time }}</td>
                        <td>
                            <a href="{{ url('technician/job/view_more_job_description/'. $value->job_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Job Synopsis</a>
                            <a href="{{ url('technician/job/update_job/'. $value->job_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Update Job Status</a>
                            <a href="{{ url('technician/job/request_assistant/'. $value->job_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Require Assistance</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noPendingJobForTechnician )
            <div style="padding: 10px; float: right;">
                {!! $viewPendingJobForTechnician->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
