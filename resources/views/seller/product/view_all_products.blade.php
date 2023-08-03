@extends('layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="mt-1 mb-5">
            <div class="mb-5">
                <h4>View All Products</h4>
            </div>
            @if (!$noProducts)
                <form action="" method="GET" class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" name="role" placeholder="Search Product Name" style="font-size: 1.5rem;">
                    </div>
                </form>
            @endif
        </div>
        @include('message_alert')
        <div class="product-wrap">
            <div class="product-list">
                @if ($noProducts)
                    <div class="input-group">
                        <input class="form-control" type="number" readonly disabled placeholder="There is no product!" style="font-size: 1.5rem; text-align: center;">
                    </div>
                @else
                    <ul class="row fill_data">
                        @foreach ($ToViewAllActiveProducts as $product)
                            <li class="col-lg-3">
                                <div class="product-box">
                                    <div class="producct-img">
                                        <img src="{{ asset('files/' . '/' . $product->filenames) }}" alt="" style="height: 350px;">
                                    </div>
                                    <div class="product-caption">
                                        <h4>{{ $product->product_name }}</h4>
                                        <div class="price">${{ $product->product_price }}</div>

                                        <a href="{{ url('seller/product/view_individual_product/' . $product->product_id) }}" class="btn btn-outline-primary">View</a>
                                        <a href="{{ url('seller/product/edit_product/' . $product->product_id) }}" class="btn btn-outline-info">Edit</a>
                                        <a href="{{ url('seller/product/delete_product/' . $product->product_id) }}" class="btn btn-outline-secondary">Delete</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div style="padding: 10px; float: right;">
                {!! $ToViewAllActiveProducts->appends(request()->except('page'))->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('keyup', '.search-input', function() {
                var product_name = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ URL::to('autoSearchProducts') }}',
                    data: {'search': product_name},
                    success: function(data) {
                        if (data && data.length > 0) {
                            var html = '';
                            $.each(data, function(index, product) {
                                var sellerID = '{{ $sellerID }}';
                                var filenames = product.filenames;
                                var productName = product.product_name;
                                var productPrice = product.product_price;
                                var productID = product.product_id;

                                html += '<li class="col-lg-3">';
                                html += '<div class="product-box">';
                                html += '<div class="producct-img">';
                                html += '<img src="{{ asset('files') }}' + '/' + filenames + '" alt="" style="height: 350px;">';
                                html += '</div>';
                                html += '<div class="product-caption">';
                                html += '<h4>' + productName + '</h4>';
                                html += '<div class="price">$' + productPrice + '</div>';
                                html += '<a href="{{ url('seller/product/view_individual_product/') }}/' + productID + '" class="btn btn-outline-primary">View</a>';
                                html += '&nbsp;';
                                html += '<a href="{{ url('seller/product/edit_product/') }}/' + productID + '" class="btn btn-outline-info">Edit</a>';
                                html += '&nbsp;';
                                html += '<a href="{{ url('seller/product/delete_product/') }}/' + productID + '" class="btn btn-outline-secondary">Delete</a>';
                                html += '</div>';
                                html += '</div>';
                                html += '</li>';
                            });
                            $('.fill_data').html(html);
                        } else {
                            var html = '<li class="col-lg-12">';
                            html += '<div class="product-box">';
                            html += '<div class="product-caption">';
                            html += '<h4>No Products Found</h4>';
                            html += '</div>';
                            html += '</div>';
                            html += '</li>';
                            $('.fill_data').html(html);
                        }
                    }
                });
            });
        });
    </script>
@endsection

