@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Deleted Jobs</h4>
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
                    </tr>
                </thead>
                <tbody>
                @if ($noDeletedJob)
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 1.5rem;">There is no delete jobs !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewAllDeletedJob as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->job_date)) }}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                           @if ($value->job_status == 3)
                                Deleted
                            @endif
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noDeletedJob )
                <div style="padding: 10px; float: right;">
                    {!! $viewAllDeletedJob->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
