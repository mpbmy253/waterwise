@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Feedbacks From Customer</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Customer Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if ($noFeedbacks)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no Feedbacks!</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($ToGetAllFeedbacks as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td>
                            <a href="{{ url('hr_customer_service/customerinteraction/view_feedback/'. $value->feedback_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Feedback</a>
                            <a href="{{ url('hr_customer_service/customerinteraction/delete_feedback/' . $value->feedback_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noFeedbacks )
                <div style="padding: 10px; float: right;">
                    {!! $ToGetAllFeedbacks->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

