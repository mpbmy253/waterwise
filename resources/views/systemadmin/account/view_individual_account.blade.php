@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Individual Account (Employee) Details</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30"  style="overflow-y: auto;">
        <form method="" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">First Name</label>
                <input class="form-control" type="text" name="firstname" value="{{ $singleUserDetails->fname }}" readonly disabled placeholder="Enter First Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Last Name</label>
                <input class="form-control" type="text" name="lastname" value="{{ $singleUserDetails->lname }}" readonly disabled placeholder="Enter Last Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Username</label>
                <input class="form-control" type="text" name="username" value="{{ $singleUserDetails->uname }}" readonly disabled placeholder="Enter User Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Email Address</label>
                <input class="form-control" type="email" name="email" value="{{ $singleUserDetails->email }}" readonly disabled placeholder="Enter Email Address" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Mobile Number</label>
                <input class="form-control" type="text" name="mobilenumber" value="{{ $singleUserDetails->mobile }}" readonly disabled placeholder="Enter Mobile Number" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Gender</label>
                <input class="form-control" type="text" name="gender" value="{{ $singleUserDetails->gender }}" readonly disabled style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Roles</label>
                <input class="form-control" type="text" name="department_name" value="{{ $singleUserDetails->role_name }}" readonly disabled style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Status</label>
                <input class="form-control" type="text" name="user_status" value="{{ $singleUserDetails->user_status == 1 ? 'Active' : '' }}" readonly disabled style="font-size: 1.5rem;">
            </div>
        </form>
    </div>
</div>

@endsection
