@extends('layouts.app')

@section('content')

<div class="min-height-200px">
    <div class="mt-1 mb-5">
        <div class="mb-5">
            <h4>View All Deleted Products</h4>
        </div>
    </div>
    <div class="card-box mb-30" style="overflow-y: auto;">
        <div class="col-sm-12">
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline ">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 1.5rem;">#</th>
                        <th scope="col" style="font-size: 1.5rem;">Product Name</th>
                        <th scope="col" style="font-size: 1.5rem;">Product Price</th>
                    </tr>
                </thead>
                <tbody>
                @if (is_string($ToViewAllDeleteProducts))
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 1.5rem;">There is no deleted Products !</td>
                    </tr>
                @else
                    @php
                    $counter = 0;
                    @endphp
                @foreach ($ToViewAllDeleteProducts as $value)
                    <tr>
                        <td scope="row" style="font-size: 1.5rem;">{{ ++$counter }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->product_name }}</td>
                        <td scope="row" style="font-size: 1.5rem;">{{ $value->product_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="padding: 10px; float: right;">
                {!! $ToViewAllDeleteProducts->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
