@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Assign other Technician That Require Assistance</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="{{ url('supervisor/job/create_job_assistance') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Current Employee Name [Requested for Assistance]</label>
                <input class="form-control" name="current_employee_name" value="{{ $ToGetAllDetailsForAssistance->employee_name }}" placeholder="Current Customer Name" type="text" style="font-size: 1.5rem;" readonly disabled>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" value="{{ $ToGetCustomerName->customer_name }}" style="font-size: 1.5rem;" readonly disabled>
                <input type="hidden" name="customer_id" value="{{ $ToGetAllDetailsForAssistance->customer_id }}">
            </div>
            <div class="form-group" data-select2-id="1">
                <label style="font-size: 1.5rem;">Employee Name [Newly Assign]<span style="color:red;">*</span></label>
                <select class="form-control custom-select2 select2-hidden-accessible" name="employee_id" required style="width: 100%"  data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @foreach ($ToGetOtherTechnicianAvailable as $value)
                        <option value="{{ $value->employee_id }}" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Date <span style="color:red;">*</span></label>
                <input class="form-control date-picker" name="job_date" required placeholder="Select Date" type="text" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Start Time <span style="color:red;">*</span></label>
                <select class="form-control" required name="job_start_time" style="font-size: 1.5rem;">
                    <option {{ old('job_start_time') == '06:00' ? 'selected' : '' }} value="06:00" style="font-size: 1.5rem;">06:00</option>
                    <option {{ old('job_start_time') == '07:00' ? 'selected' : '' }} value="07:00" style="font-size: 1.5rem;">07:00</option>
                    <option {{ old('job_start_time') == '08:00' ? 'selected' : '' }} value="08:00" style="font-size: 1.5rem;">08:00</option>
                    <option {{ old('job_start_time') == '09:00' ? 'selected' : '' }} value="09:00" style="font-size: 1.5rem;">09:00</option>
                    <option {{ old('job_start_time') == '10:00' ? 'selected' : '' }} value="10:00" style="font-size: 1.5rem;">10:00</option>
                    <option {{ old('job_start_time') == '11:00' ? 'selected' : '' }} value="11:00" style="font-size: 1.5rem;">11:00</option>
                    <option {{ old('job_start_time') == '12:00' ? 'selected' : '' }} value="12:00" style="font-size: 1.5rem;">12:00</option>
                    <option {{ old('job_start_time') == '13:00' ? 'selected' : '' }} value="13:00" style="font-size: 1.5rem;">13:00</option>
                    <option {{ old('job_start_time') == '14:00' ? 'selected' : '' }} value="14:00" style="font-size: 1.5rem;">14:00</option>
                    <option {{ old('job_start_time') == '15:00' ? 'selected' : '' }} value="15:00" style="font-size: 1.5rem;">15:00</option>
                    <option {{ old('job_start_time') == '16:00' ? 'selected' : '' }} value="16:00" style="font-size: 1.5rem;">16:00</option>
                    <option {{ old('job_start_time') == '17:00' ? 'selected' : '' }} value="17:00" style="font-size: 1.5rem;">17:00</option>
                    <option {{ old('job_start_time') == '18:00' ? 'selected' : '' }} value="18:00" style="font-size: 1.5rem;">18:00</option>
                </select>
                @error('job_start_time')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem; ">Job Synopsis [Root Cause] <span style="color:red;">*</span></label>
                <textarea class="form-control" name="job_description" required placeholder="Enter Job Synopsis" style="font-size: 1.5rem; height:700px">- To Assist {{ $ToGetAllDetailsForAssistance->employee_name }}&#10;- {{ $ToGetAllDetailsForAssistance->job_description }}
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Send Assistance Over</button>
        </form>
    </div>
</div>
@endsection
