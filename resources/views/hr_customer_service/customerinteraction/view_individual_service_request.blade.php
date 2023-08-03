@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Service Request</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" type="text" name="customer_name" value="{{ $individualServiceRequest->customer_name }}" readonly disabled placeholder="Enter Customer Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Date</label>
                <input class="form-control date-picker" name="date" value="{{  date('d / M / Y', strtotime($individualServiceRequest->service_date)) }}" readonly disabled placeholder="Select Date" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Service Description</label>
                <textarea style="font-size: 1.5rem; height:700px" class="form-control" name="feedback" readonly disabled placeholder="Enter Feedbacks">{{ $individualServiceRequest->service_description }}</textarea>
            </div>
        </form>
    </div>
</div>

@endsection
