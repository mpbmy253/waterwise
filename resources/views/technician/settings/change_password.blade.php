@extends('layouts.app')

@section('content')

<div class="min-height-200px" style="overflow-y: auto;">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>My Account</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Old Password <span style="color:red;">*</span></label>
                <input type="password" class="form-control" name="old_password" required placeholder="Enter Old Password" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">New Password <span style="color:red;">*</span></label>
                <input type="password" class="form-control" name="new_password" required placeholder="Enter New Password" style="font-size: 1.5rem;">
                <small class="form-text text-muted">
                    Your password must be 8-20 characters long, contain letters and numbers, at least 1 special characters, and must not contain spaces
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>

@endsection

