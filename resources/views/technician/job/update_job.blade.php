@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Updating Job Status</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group" data-select2-id="2">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" name="customer_name" value="{{ $jobDescription->customer_name }} " readonly disabled placeholder="Customer Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Date</label>
                <input class="form-control date-picker" name="date" value="{{  date('d / M / Y', strtotime($jobDescription->job_date)) }}" readonly placeholder="Select Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Start Time</label>
                <input class="form-control" type="time" name="start_time" value="{{ $jobDescription->job_start_time }}" readonly  placeholder="Enter Start Time" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Start Time <span style="color:red;">*</span></label>
                <select class="form-control" required name="job_end_time" style="font-size: 1.5rem;">
                    <option {{ old('job_end_time') == '06:00' ? 'selected' : '' }} value="06:00" style="font-size: 1.5rem;">06:00</option>
                    <option {{ old('job_end_time') == '07:00' ? 'selected' : '' }} value="07:00" style="font-size: 1.5rem;">07:00</option>
                    <option {{ old('job_end_time') == '08:00' ? 'selected' : '' }} value="08:00" style="font-size: 1.5rem;">08:00</option>
                    <option {{ old('job_end_time') == '09:00' ? 'selected' : '' }} value="09:00" style="font-size: 1.5rem;">09:00</option>
                    <option {{ old('job_end_time') == '10:00' ? 'selected' : '' }} value="10:00" style="font-size: 1.5rem;">10:00</option>
                    <option {{ old('job_end_time') == '11:00' ? 'selected' : '' }} value="11:00" style="font-size: 1.5rem;">11:00</option>
                    <option {{ old('job_end_time') == '12:00' ? 'selected' : '' }} value="12:00" style="font-size: 1.5rem;">12:00</option>
                    <option {{ old('job_end_time') == '13:00' ? 'selected' : '' }} value="13:00" style="font-size: 1.5rem;">13:00</option>
                    <option {{ old('job_end_time') == '14:00' ? 'selected' : '' }} value="14:00" style="font-size: 1.5rem;">14:00</option>
                    <option {{ old('job_end_time') == '15:00' ? 'selected' : '' }} value="15:00" style="font-size: 1.5rem;">15:00</option>
                    <option {{ old('job_end_time') == '16:00' ? 'selected' : '' }} value="16:00" style="font-size: 1.5rem;">16:00</option>
                    <option {{ old('job_end_time') == '17:00' ? 'selected' : '' }} value="17:00" style="font-size: 1.5rem;">17:00</option>
                    <option {{ old('job_end_time') == '18:00' ? 'selected' : '' }} value="18:00" style="font-size: 1.5rem;">18:00</option>
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Reports <span style="color:red;">*</span></label>
                <textarea style="font-size: 1.5rem; height:700px" class="form-control" name="job_report" required placeholder="Enter Job Report"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Completed</button>
        </form>
    </div>
</div>

@endsection

