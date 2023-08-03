@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="container pt-30 pb-30">
        <div class="card">
            <div class="card-body">
                <div class="mt-1 mb-5">
                    <div class="mb-5">
                        <h4>Payment</h4>
                    </div>
                </div>
                @include('message_alert')
                <form id="payment-form" method="post" action="">
                    {{ @csrf_field() }}
                    <div class="form-group">
                        <label style="font-size: 1.5rem;">Card Holder's Name <span style="color:red;">*</span></label>
                        <input type="text" name="card_name" class="form-control" required placeholder="Enter Card Name" style="font-size: 1.5rem;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 1.5rem;">Card Number <span style="color:red;">*</span></label>
                        <input type="number" name="card_number" class="form-control" required placeholder="Enter Card Number" style="font-size: 1.5rem;" >
                    </div>
                    <div class="form-group">
                        <label style="font-size: 1.5rem;">CVC Number <span style="color:red;">*</span></label>
                        <input type="number" name="cvc_number" class="form-control" required placeholder="Enter CVC Number" style="font-size: 1.5rem;">
                    </div>
                    <div class="form-group row">
                        <label style="font-size: 1.5rem;" class="col-md-12">Card Expire <span style="color:red;">*</span></label>
                        <div class="col-md-4">
                            <label style="font-size: 1.5rem;" class="col-md-4">Month</label>
                            <select class="form-control" name="card_expire_month" style="font-size: 1.5rem;">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 1.5rem;" class="col-md-4">Year</label>
                            <select class="form-control" name="card_expire_yr" style="font-size: 1.5rem;">
                                <option value="23">2023</option>
                                <option value="24">2024</option>
                                <option value="25">2025</option>
                                <option value="26">2026</option>
                                <option value="27">2027</option>
                                <option value="28">2028</option>
                                <option value="29">2029</option>
                                <option value="30">2030</option>
                                <option value="31">2031</option>
                                <option value="32">2032</option>
                                <option value="33">2033</option>
                                <option value="34">2034</option>
                                <option value="35">2035</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-info btn-lg btn-block" style="font-size: 1.5rem;">Cancel</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" style="font-size: 1.5rem;">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="progress mb-20">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle form submission
        $('#payment-form').submit(function(event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            // Animate the progress bar
            var progressBar = $('.progress-bar');
            progressBar.animate({ width: '100%' }, 2000, function() {
                // After the animation, submit the form
                $('#payment-form').off('submit').submit();
            });
        });

        // Handle cancel button click
        $('button[type="reset"]').click(function() {
            // Go back to the previous page
            window.history.back();
        });
    });
</script>
@endsection
