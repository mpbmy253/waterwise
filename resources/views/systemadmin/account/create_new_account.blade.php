@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Create New Account (Employee)</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">First Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" required placeholder="Enter First Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Last Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}"  required placeholder="Enter Last Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Username <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="username" value="{{ old('username') }}"  required placeholder="Enter User Name" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;"> {{ $errors->first('username') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Email Address <span style="color:red;">*</span></label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter Email Address" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;"> {{ $errors->first('email') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Mobile Number <span style="color:red;">*</span></label>
                <input class="form-control" type="number" name="mobile" value="{{ old('mobile') }}"  required placeholder="Enter Mobile Number" style="font-size: 1.5rem;">
                <div style="color:red; font-size: 1.5rem;"> {{ $errors->first('mobile') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Gender <span style="color:red;">*</span></label>
                <select class="form-control" required name="gender" style="font-size: 1.5rem;">
                    <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male" style="font-size: 1.5rem;">Male</option>
                    <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female" style="font-size: 1.5rem;">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Department <span style="color:red;">*</span></label>
                <select class="form-control" required name="role" style="font-size: 1.5rem;">
                    @foreach ($activeRole as $value)
                        <option value="{{ $value->role_name }}" style="font-size: 1.5rem;">{{ $value->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Password <span style="color:red;">*</span></label>
                <input class="form-control" type="password" name="password" required placeholder="Enter Password" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Create New Account</button>
        </form>
    </div>
</div>

@endsection

