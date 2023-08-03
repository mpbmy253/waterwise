@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Pending Sellers</h4>
        </div>
    </div>
    @include('message_alert')
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">S/N</th>
                        <th scope="col" style="font-size: 1.5rem;">Seller Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Company UEN</th>
                        <th scope="col" style="font-size: 1.5rem;">Company Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Payment</th>
                        <th scope="col" style="font-size: 1.5rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (is_string($pendingSeller))
                    <tr>
                        <td colspan="6" style="text-align: center;">{{ $pendingSeller }}</td>
                    </tr>
                @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($pendingSeller as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->fname}}  {{ $value->lname}}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->company_uen}}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->company_name}}</td>
                        <td scope="row" style="font-size: 1.5rem;">
                            @if ($value->payment == 1)
                                PAID
                            @else
                                NOT PAID
                            @endif
                        </td>
                        <td>
                           <a href="{{ url('platformadmin/seller/approve/'. $value->company_id) }}" class="btn btn-sm btn-primary" style="font-size: 1.5rem;">Approved</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $pendingSeller->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
