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
                <input class="form-control" name="employee_name" value="{{ $jobDescription->employee_name }}" readonly disabled placeholder="Select Employee" style="font-size: 1.5rem;">
            </div>
            <div class="form-group" data-select2-id="2">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" name="customer_name" value="{{ $jobDescription->customer_name }} " readonly disabled placeholder="Select Employee" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Date <span style="color:red;">*</span></label>
                <input class="form-control date-picker" name="job_date" value="{{ date('d / M / Y', strtotime($jobDescription->job_date)) }}" readonly disabled placeholder="Select Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Start Time  <span style="color:red;">*</span></label>
                <input class="form-control" name="job_start_time" value="{{ $jobDescription->job_start_time }} " readonly disabled placeholder="Select Start Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Job Synopsis [Root Cause] <span style="color:red;">*</span></label>
                <textarea class="form-control" name="job_description" required placeholder="Enter Job Description" style="font-size: 1.5rem; height:700px">{{ old('job_description', $jobDescription->job_description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Edit Job</button>
        </form>
    </div>
</div>

@endsection
