@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Jobs Require Assistance</h4>
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
                        <th scope="col" style="font-size: 1.5rem;">Status</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($noRequireAssistance)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no employee require assistance !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewAllJobRequireAssistance as $value)
                <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->job_date)) }}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                            @if ($value->job_status == 2)
                                Require Assistance
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('supervisor/job/send_assistance/'.$value->job_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Sending Assistance Help Over</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noRequireAssistance )
                <div style="padding: 10px; float: right;">
                    {!! $viewAllJobRequireAssistance->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
