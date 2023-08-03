@extends('layouts.app')
@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>Create New System Admin Account For Company</h4>
        </div>
    </div>

    @include('message_alert')
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <form method="post" action="">
            {{ @csrf_field() }}
            <div class="form-group">
                <label style="font-size: 1.5rem;">Company <span style="color:red;">*</span></label>
                <select class="form-control company_listing" required name="company" style="font-size: 1.5rem;">
                    <option value="">Select Company</option>
                    @foreach ($sysAdminNotYetCreatedCompany as $value)
                        <option style="font-size: 1.5rem;" value="{{ $value->company_id }}">{{ $value->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">First Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" readonly placeholder="Enter First Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Last Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname') }}"  readonly placeholder="Enter Last Name" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Username <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="username" value="{{ old('username') }}"  required placeholder="Enter User Name" style="font-size: 1.5rem;">
                <div style="color:red"> {{ $errors->first('username') }} </div>
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Email Address <span style="color:red;">*</span></label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" readonly placeholder="Enter Email Address" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Mobile Number <span style="color:red;">*</span></label>
                <input class="form-control" type="number" id="mobile" name="mobile" value="{{ old('mobile') }}"  readonly placeholder="Enter Mobile Number" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Gender <span style="color:red;">*</span></label>
                <input class="form-control" type="text" id="gender" name="gender" value="{{ old('gender') }}"  readonly placeholder="Enter Gender" style="font-size: 1.5rem;">
            </div>
            <div class="form-group">
                <label style="font-size: 1.5rem;">Password <span style="color:red;">*</span></label>
                <input class="form-control" type="password" name="password" required placeholder="Enter Password" style="font-size: 1.5rem;">
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 1.5rem;">Create New System Admin Account</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('change', '.company_listing', function() {
            var company_id = $(this).val();

            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoFillUserDetailsBasedOnCompanySelection') !!}',
                data: {'id': company_id},
                success:function(data) {
                    $('#firstname').val(data.fname);
                    $('#lastname').val(data.lname);
                    $('#email').val(data.email);
                    $('#mobile').val(data.mobile);
                    $('#gender').val(data.gender);
                }
            });
        });
    });
</script>
@endsection

