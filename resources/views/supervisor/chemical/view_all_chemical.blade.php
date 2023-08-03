@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Chemical (Available)</h4>
        </div>
        <div class="input-group">
            <input type="text" class="form-control search-input" placeholder="Search Chemical Name" style="font-size: 1.5rem;">
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Chemical Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Chemical Price</th>
                        <th scope="col" style="font-size: 1.5rem;">Chemical Level</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody class="fill_data">
                @if ($noActiveChemical)
                    <tr>
                        <td colspan="5" style="text-align: center; font-size: 1.5rem;">There is no Checmical found !</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewActiveChemical as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="chemical_name" scope="row" style="font-size: 1.5rem;">{{ $value->chemical_name }}</td>
                        <td class="chemical_price" scope="row" style="font-size: 1.5rem;">${{ $value->chemical_price }}</td>
                        <td class="chemical_level" scope="row" style="font-size: 1.5rem;">{{ $value->chemical_level}} mg/L</td>
                        <td>
                            <a href="{{ url('supervisor/chemical/view_individual_chemical/'. $value->chemical_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>
                            <a href="{{ url('supervisor/chemical/edit_chemical/' . $value->chemical_id) }}" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>
                            <a href="{{ url('supervisor/chemical/delete_chemical/' . $value->chemical_id) }}" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>
                            <a href="{{ url('supervisor/chemical/suspend_chemical/' . $value->chemical_id) }}" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if(!$noActiveChemical)
                <div style="padding: 10px; float: right;">
                    {!! $viewActiveChemical->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('keyup', '.search-input', function() {
            var chemical_name = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! URL::to('autoSearchChemicals') !!}',
                data: {'search': chemical_name},
                success: function(data) {
                    if (data && data.length > 0)  {
                        var html = '';
                        $.each(data, function(index, chemical) {
                            html += '<tr>';
                            html += '<td style="font-size: 1.5rem;">' + (index + 1) + '</td>';
                            html += '<td class="chemical_name" style="font-size: 1.5rem;">' + chemical.chemical_name + '</td>';
                            html += '<td class="chemical_price" style="font-size: 1.5rem;">$' + chemical.chemical_price + '</td>';
                            html += '<td class="chemical_level" style="font-size: 1.5rem;">' + chemical.chemical_level + ' mg/L</td>';
                            html += '<td>';
                            html += '<a href="{{ url("supervisor/chemical/view_individual_chemical/") }}/' + chemical.chemical_id + '" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">View</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/chemical/edit_chemical/") }}/' + chemical.chemical_id + '" class="btn btn-sm btn-warning" style="font-size: 1.5rem;">Edit</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/chemical/delete_chemical/") }}/' + chemical.chemical_id + '" class="btn btn-sm btn-danger" style="font-size: 1.5rem;">Delete</a>';
                            html += '&nbsp;';
                            html += '<a href="{{ url("supervisor/chemical/suspend_chemical/") }}/' + chemical.chemical_id + '" class="btn btn-sm btn-info" style="font-size: 1.5rem;">Suspend</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('.fill_data').html(html);
                    } else {
                       var html = '';
                        html += '<tr>';
                        html += '<td colspan="6" style="text-align: center;">There is no chemical found !</td>';
                        html += '</tr>';
                        $('.fill_data').html(html);
                    }
                }
            });
        });
    });
</script>
@endsection
