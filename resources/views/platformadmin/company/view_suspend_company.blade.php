@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Suspend Company</h4>
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Company UEN</th>
                        <th scope="col" style="font-size: 1.5rem;">Company Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Payment</th>
                    </tr>
                </thead>
                <tbody>
                @if (is_string($suspendCompany))
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 1.5rem;">{{ $suspendCompany }}</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($suspendCompany as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->company_uen}}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->company_name}}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                            @if ($value->payment == 1)
                                PAID
                            @else
                                NOT PAID
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $suspendCompany->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
