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
                <label style="font-size: 1.5rem;">First Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="firstname" value="{{ old('firstname', $ToKnowTechnicianDetails->fname) }}" required placeholder="Enter First Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Last Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="lastname" value="{{ old('lastname', $ToKnowTechnicianDetails->lname) }}" required placeholder="Enter Last Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Username <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="username" value="{{ old('username', $ToKnowTechnicianDetails->uname) }}" required placeholder="Enter User Name" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('username') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Email Address</label>
                <input class="form-control" type="email" name="email" value="{{ old('email', $ToKnowTechnicianDetails->email) }}" required placeholder="Enter Email Address" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('email') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Mobile Number <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="mobile" value="{{ old('mobile', $ToKnowTechnicianDetails->mobile) }}" required placeholder="Enter Mobile Number" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('mobile') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Gender</label>
                <input class="form-control" type="text" name="gender" value="{{ old('gender', $ToKnowTechnicianDetails->gender) }}" readonly placeholder="Enter Gender" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Update My Account</button>
        </form>
    </div>
</div>

@endsection

