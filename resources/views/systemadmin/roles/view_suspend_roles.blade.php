@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Suspended Roles</h4>
        </div>
    </div>
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
                <tbody>
                @if (is_string($suspendRole))
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 1.5rem;">{{ $suspendRole }}</td>
                    </tr>
                @else
                    @php
                    $counter = 0;
                    @endphp
                @foreach ($suspendRole as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->role_name }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->role_description }}</td>
                        <td>
                            <a href="{{ url('systemadmin/roles/activate_roles/' . $value->role_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Activate</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $suspendRole->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
