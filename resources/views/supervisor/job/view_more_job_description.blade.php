@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Job Description</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group" data-select2-id="1">
                <label style="font-size: 1.5rem;">Employee Name</label>
                <input class="form-control" name="employee_name" value="{{ $individualEmployeeJob->employee_name }} " readonly disabled placeholder="Employee Namme" style="font-size: 1.5rem;">
            </div>
            <div class="form-group" data-select2-id="2">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" name="customer_name" value="{{ $individualEmployeeJob->customer_name }} " readonly disabled placeholder="Customer Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Date</label>
                <input class="form-control date-picker" name="date" value="{{  date('d / M / Y', strtotime($individualEmployeeJob->job_date)) }}" readonly disabled placeholder="Select Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Start Time</label>
                <input class="form-control" type="time" name="start_time" value="{{ $individualEmployeeJob->job_start_time }}" readonly disabled  placeholder="Enter Start Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Job Synopsis [Root Cause]</label>
                <textarea class="form-control" name="job_description" readonly disabled placeholder="Enter Job Description" style="font-size: 1.5rem; height:700px">{{ $individualEmployeeJob->job_description }}</textarea>
            </div>
        </form>
    </div>
</div>

@endsection

