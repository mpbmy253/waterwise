@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Chemical (Deleted)</h4>
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Equipment Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Equipment Price</th>
                        <th scope="col" style="font-size: 1.5rem;">Guarantee Period</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (is_string($viewDeleteChemical))
                    <tr>
                        <td colspan="5" style="text-align: center; font-size: 1.5rem;">{{ $viewDeleteChemical }}</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($viewDeleteChemical as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td class="chemical_name" scope="row" style="font-size: 1.5rem;">{{ $value->chemical_name }}</td>
                        <td class="chemical_price" scope="row" style="font-size: 1.5rem;">${{ $value->chemical_price }}</td>
                        <td class="chemical_level" scope="row" style="font-size: 1.5rem;">{{ $value->chemical_level}} mg/L</td>
                        <td>
                            <a href="{{ url('supervisor/chemical/restore_chemical/' . $value->chemical_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Restore</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $viewDeleteChemical->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
