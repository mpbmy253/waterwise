@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Report</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="" action="">
            <div class="form-group">
                <label style="font-size: 1.5rem;">Employee Name</label>
                <input class="form-control" type="text" name="employee_name" value="{{ $individualEmployeeJob->employee_name }}" readonly disabled placeholder="Enter Employee Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" type="text" name="customer_name" value="{{ $individualEmployeeJob->customer_name }}" readonly disabled placeholder="Enter Customer Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Time</label>
                <input class="form-control" type="text" name="time" value="{{ $individualEmployeeJob->job_start_time }} - {{ $individualEmployeeJob->job_end_time }}" readonly disabled placeholder="Enter Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem; ">Job Synopsis [Root Cause]</label>
                <textarea class="form-control" name="job_synopsis" readonly disabled placeholder="Enter Job Synopsis" style="font-size: 1.5rem; height:450px">{{ $individualEmployeeJob->job_description }}</textarea>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem; ">Report</label>
                <textarea class="form-control" name="job_report"  readonly disabled placeholder="Enter Job Report" style="font-size: 1.5rem; height:450px">{{ $individualEmployeeJobReport->job_report }}</textarea>
            </div>

        </form>
    </div>
</div>

@endsection

