@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Individual Roles Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">First Name</label>
                <input class="form-control" type="text" name="role_name" value="{{ $singleRole->role_name }}" readonly disabled placeholder="Enter First Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Last Name</label>
                <input class="form-control" type="text" name="role_description" value="{{ $singleRole->role_description }}" readonly disabled placeholder="Enter Last Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Status</label>
                <input class="form-control" type="text" name="role_status" value="{{ $singleRole->role_status == 1 ? 'Active' : '' }}" readonly disabled style="font-size: 1.5rem;">
            </div>
        </form>
    </div>
</div>

@endsection
