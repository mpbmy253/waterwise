@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Active Account (Employee)</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Employee Name or User Name" style="font-size: 1.5rem;">
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
                        <th scope="col" style="font-size: 1.5rem;">User Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Mobile Number</th>
                        <th scope="col" style="font-size: 1.5rem;">Roles</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noActiveEmployee)
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no account found !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($activeEmployee as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="employee_name" scope="row" style="font-size: 1.5rem;">{{ $value->fname }} {{ $value->lname }}</td>
                        <td class="employee_username" scope="row" style="font-size: 1.5rem;">{{ $value->uname }}</td>
                        <td class="employee_mobile" scope="row" style="font-size: 1.5rem;">{{ $value->mobile }}</td>
                        <td class="employee_role" scope="row" style="font-size: 1.5rem;">{{ $value->role_name}}</td>
                        <td>
                            <a href="{{ url('systemadmin/account/view_individual_account/'. $value->user_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>
                            <a href="{{ url('systemadmin/account/edit_account/' . $value->user_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                            <a href="{{ url('systemadmin/account/delete_account/' . $value->user_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                            <a href="{{ url('systemadmin/account/suspend_account/' . $value->user_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noActiveEmployee )
                <div style="padding: 10px; float: right;">
                    {!! $activeEmployee->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                url: '{!! URL::to('autoSearchAccount') !!}',
                data: {'search': employee_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, employee) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="employee_name" style="font-size: 1.5rem;">' + employee.fname + ' ' + employee.lname +'</td>';
                            html += '<td class="employee_username" style="font-size: 1.5rem;">' + employee.uname + '</td>';
                            html += '<td class="employee_mobile" style="font-size: 1.5rem;">' + employee.mobile + '</td>';
                            html += '<td class="employee_role" style="font-size: 1.5rem;">' + employee.role_name + '</td>';
                            html += '<td>';
                            html += '<a href="{{ url("systemadmin/account/view_individual_account") }}/' + employee.user_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("systemadmin/account/edit_account") }}/' + employee.user_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("systemadmin/account/delete_account") }}/' + employee.user_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("systemadmin/account/suspend_account") }}/' + employee.user_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="6" style="text-align: center; font-size: 1.5rem;">There is no such employee found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
