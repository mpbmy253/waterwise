@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Feedbacks</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Customer Name</label>
                <input class="form-control" type="text" name="customer_name" value="{{ $individualFeedback->customer_name }}" readonly disabled placeholder="Enter Customer Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Feedback</label>
                <textarea style="font-size: 1.5rem; height:300px" class="form-control" name="feedback" readonly disabled placeholder="Enter Feedbacks">{{ $individualFeedback->feedback }}</textarea>
            </div>
            <button id="reply-feedback-button" type="button" class="btn btn-primary" style="font-size: 1.5rem;">Reply Feedback</button>
        </form>
        <br>
        <form id="reply-feedback-form" method="POST" action="{{ url('hr_customer_service/customerinteraction/reply_feedback') }}" style="display: none;">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Reply Feedback</label>
                <textarea style="font-size: 1.5rem; height:300px" class="form-control" name="reply_feedback" placeholder="Enter Reply Feedbacks"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Send Reply Feedback</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('reply-feedback-button').addEventListener('click', function() {
            document.getElementById('reply-feedback-form').style.display = 'block';
        });
    });
</script>

@endsection
