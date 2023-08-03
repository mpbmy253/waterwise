@extends('layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="mt-1 mb-5">
            <div class="mb-5">
                <h4>View All Active Roles</h4>
            </div>

            <div class="input-group">
                <input type="text" class="form-control search-input" placeholder="Search Roles" style="font-size: 1.5rem;">
            </div>
        </div>
        @include('message_alert')
        <div class="card-box mb-30" style="overflow-y: auto;">
            <div class="col-sm-12">
                <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                    <thead>
                        <tr>
                            <th scope="col" style="font-size: 1.5rem;">S/N</th>
                            <th scope="col" style="font-size: 1.5rem;">Role Name</th>
                            <th scope="col" style="font-size: 1.5rem;">Role Description</th>
                            <th scope="col" style="font-size: 1.5rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fill_data">
                        @php
                            $counter = 1;
                        @endphp
                        {{-- IF $noActiveRole NOT EMPTY --}}
                        @if (!$noActiveRole)
                            @foreach ($activeRole as $value)
                                @if ($counter <= 3)
                                    <tr>
                                        <td scope="row" style="font-size: 1.5rem;">{{ $counter }}</td>
                                        <td class="role_name" scope="row" style="font-size: 1.5rem;">{{ $value->role_name }}</td>
                                        <td class="role_description" scope="row" style="font-size: 1.5rem;">{{ $value->role_description }}</td>
                                        <td scope="row" style="font-size: 1.5rem;">DEFAULT</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td scope="row" style="font-size: 1.5rem;">{{ $counter }}</td>
                                        <td class="role_name" scope="row" style="font-size: 1.5rem;">{{ $value->role_name }}</td>
                                        <td class="role_description" scope="row" style="font-size: 1.5rem;">{{ $value->role_description }}</td>
                                        <td>
                                            <a href="{{ url('systemadmin/roles/view_individual_role/'. $value->role_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>
                                            <a href="{{ url('systemadmin/roles/edit_roles/' . $value->role_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                                            <a href="{{ url('systemadmin/roles/delete_roles/' . $value->role_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                                            <a href="{{ url('systemadmin/roles/suspend_roles/' . $value->role_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        {{-- IF $noActiveRole IS EMPTY --}}
                        @else
                            @if ($counter <= 3)
                                <tr>
                                    <td scope="row" style="font-size: 1.5rem;">{{ $counter }}</td>
                                    <td scope="row" style="font-size: 1.5rem;">DEFAULT</td>
                                    <td scope="row" style="font-size: 1.5rem;">DEFAULT</td>
                                    <td scope="row" style="font-size: 1.5rem;">DEFAULT</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
                @if(!$noActiveRole )
                <div style="padding: 10px; float: right;">
                    {!! $activeRole->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
            var role_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchUserProfile') !!}',
                data: { 'search': role_name },
                success: function(data) {
                    if (data && data.length > 0) {
                        var html = '';
                        $.each(data, function(index, roles) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="role_name" style="font-size: 1.5rem;">' + roles.role_name + '</td>';
                            html += '<td class="role_description" style="font-size: 1.5rem;">' + roles.role_description + '</td>';

                            // Check role name and conditionally display actions
                            if (roles.role_name === 'HR & Customer Service' ||
                                roles.role_name === 'Supervisor' ||
                                roles.role_name === 'Technician') {
                                html += '<td scope="row" style="font-size: 1.5rem;">DEFAULT</td>';
                            } else {
                                html += '<td>';
                                html += '<a href="{{ url("systemadmin/roles/view_individual_role") }}/' + roles.role_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>';
                                html += '&nbsp;';
                                html += '<a href="{{ url("systemadmin/roles/edit_roles") }}/' + roles.role_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                                html += '&nbsp;';
                                html += '<a href="{{ url("systemadmin/roles/delete_roles") }}/' + roles.role_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                                html += '&nbsp;';
                                html += '<a href="{{ url("systemadmin/roles/suspend_roles") }}/' + roles.role_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                                html += '</td>';
                            }
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                        var html = '';
                        html += '<tr>';
                        html += '<td colspan="5" style="text-align: center; font-size: 1.5rem;">There are no roles found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
