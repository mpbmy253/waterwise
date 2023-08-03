@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Not Completed Jobs</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Employee Name" style="font-size: 1.5rem;">
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
                        <th scope="col" style="font-size: 1.5rem;">Start Time</th>
                        <th scope="col" style="font-size: 1.5rem;">Status</th>
                        <th scope="col" style="font-size: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noPendingJob)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no pending jobs for employee !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewAllPendingJob as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ date('d / M / Y', strtotime($value->job_date)) }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->job_start_time }}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                            @if ($value->job_status == 0)
                                Not Completed
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('supervisor/job/view_more_job_description/'. $value->job_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Job Synopsis</a>
                            <a href="{{ url('supervisor/job/edit_job/' . $value->job_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                            <a href="{{ url('supervisor/job/delete_job/' . $value->job_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noPendingJob )
                <div style="padding: 10px; float: right;">
                    {!! $viewAllPendingJob->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('keyup', '.search-input', function() {
            var employee_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchAllPendingJobs') !!}',
                data: {'search': employee_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, employee) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="employee_name" style="font-size: 1.5rem;">' + employee.fname + ' ' + employee.lname +'</td>';
                            html += '<td class="date" style="font-size: 1.5rem;">' + formatDate(employee.job_date) + '</td>';
                            html += '<td class="start_time" style="font-size: 1.5rem;">' + employee.job_start_time + '</td>';
                            html += '<td class="job_status" style="font-size: 1.5rem;">Not Completed</td>';
                            html += '<td>';
                            html += '<a href="{{ url("supervisor/job/view_more_job_description/") }}/' + employee.job_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View Job Synopsis</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/job/edit_job/") }}/' + employee.job_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/job/delete_job/") }}/' + employee.job_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no Employee found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });

    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = ("0" + date.getDate()).slice(-2); // Add leading zero if day is a single digit
        var month = date.toLocaleString('default', { month: 'short' });
        var year = date.getFullYear();
        return day + '/ ' + month + ' /' + year;
    }

</script>
@endsection

