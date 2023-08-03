
@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Create New Roles</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Role Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="role_name" required placeholder="Enter Role Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Role Description <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="role_description" required placeholder="Enter Role Description" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Create New Role</button>
        </form>
    </div>

</div>
@endsection
