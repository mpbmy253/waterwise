@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View Individual Customer Meter </h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30" style="overflow-y: auto;">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                @foreach($pipeNames as $pipeName)
                <div class="form-group">
                    <label style="font-size: 1.5rem;">Pipe Name</label>
                    <input type="text" class="form-control" name="pipe_name" value="{{ old('pipe_name', $pipeName) }}" readonly style="font-size: 1.5rem;">
                </div>
                @endforeach
            </div>
            <div class="col-md-3 col-sm-12">
                @foreach($leakStatus as $index => $leakStatusUpdate)
                <div class="form-group">
                    <label style="font-size: 1.5rem;">Leak Status</label>
                    <input type="text" class="form-control {{ $leakStatusUpdate == 1 ? 'text-danger' : '' }}" id="leak_status_{{ $index }}" name="leak_status" value="{{ old('leak_status', $leakStatusUpdate == 1 ? 'Leaking' : 'No Leak') }}" readonly style="font-size: 1.5rem;">
                </div>
                @endforeach
            </div>
            <div class="col-md-3 col-sm-12">
                @foreach($pipeStatus as $pipeStatusUpdate)
                <div class="form-group">
                    <label style="font-size: 1.5rem;">Pipe Status</label>
                    <input type="text" class="form-control" name="pipe_status" value="{{ old('pipe_status', $pipeStatusUpdate == 1 ? 'Not working' : 'Working') }}" readonly style="font-size: 1.5rem;">
                </div>
                @endforeach
            </div>
            <div class="col-md-3 col-sm-12">
                @foreach($meterValue as $index => $meterReading)
                <div class="form-group">
                    <label style="font-size: 1.5rem;">Meter Value</label>
                    <input type="text" class="form-control meter-reading {{ $leakStatus[$index] == 1 ? 'leaking-meter' : ($leakStatus[$index] == 2 ? 'non-leaking-meter' : '') }}" id="meter_value_{{ $index }}" name="meter_value" value="{{ old('meter_value', $meterReading) }} cu M" data-pipe="{{ $pipeNames[$index] }}" readonly style="font-size: 1.5rem;">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.leaking-meter').each(function() {
            var meterReading = parseFloat($(this).val().replace(' cu M', ''));
            setInterval(function() {
                meterReading += 0.25;
                $(this).val(meterReading.toFixed(2) + ' cu M');

                if (meterReading > 50) {
                    var index = $(this).data('pipe');
                    $('#leak_status_' + index).val('Leaking');
                }
            }.bind(this), 100); // 100 = 0.1 second
        });

        $('.non-leaking-meter').each(function() {
            var meterReading = parseFloat($(this).val().replace(' cu M', ''));
            setInterval(function() {
                meterReading += 0.05;
                $(this).val(meterReading.toFixed(2) + ' cu M');

                if (meterReading > 50) {
                    var index = $(this).data('pipe');
                    $('#leak_status_' + index).val('Leaking');
                }
            }.bind(this), 3000); // 3000 = 3 seconds
        });
    });
</script>
@endsection
