@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Completed Jobs</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Employee Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Date</th>
                        <th scope="col" style="font-size: 1.5rem;">Start Time</th>
                        <th scope="col" style="font-size: 1.5rem;">End Time</th>
                        <th scope="col" style="font-size: 1.5rem;">Status</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noCompletedJob)
                    <tr>
                        <td colspan="7" style="text-align: center; font-size: 1.5rem;">There is no completed jobs for employees!</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewAllCompletedJob as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->job_date)) }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->job_start_time }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->job_end_time }}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                           @if ($value->job_status == 1)
                                Completed
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('supervisor/job/view_report/'. $value->job_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Report</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noCompletedJob )
                <div style="padding: 10px; float: right;">
                    {!! $viewAllCompletedJob->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
