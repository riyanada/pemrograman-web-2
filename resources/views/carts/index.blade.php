@extends('layouts.app')

@section('content')
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 50%">Product</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 8%">Quantity</th>
                    <th style="width: 22%" class="text-center">Subtotal</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $id => $product)
                        @php
                            $total += $product['price'] * $product['quantity'];
                        @endphp
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs">
                                        <img src="{{ route('products.image', ['imageName' => $product['image_url']]) }}"
                                            alt="iamge" width="100" height="100" class="img-responsive">
                                    </div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $product['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price"> ${{ $product['price'] }} </td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $product['quantity'] }}" class="form-control quantity">
                            </td>
                            <td data-th="Subtotal" class="text-center">${{ $product['price'] * $product['quantity'] }}</td>
                            <td class="action" data-th="">
                                <button class="btn btn-info btn-sm update-cart"
                                    data-id="{{ $id }}">Update</button>
                                <button class="btn btn-danger btn-sm mt-2 remove-cart"
                                    data-id="{{ $id }}">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"> <strong> Total {{ $total }} </strong> </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Lanjutkan
                            Belanja</a>
                        <a href="javascript:;" class="btn btn-primary"><i class="fa fa-angle-left">Lanjut ke
                                Pembayaran</i></a>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp.{{ $total }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".update-cart").click(function(e) {
                e.preventDefault();
                console.log('a');
                var ele = $(this);

                $.ajax({
                    url: '{{ route('carts.update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            });
            $(".remove-cart").click(function(e) {
                e.preventDefault();
                console.log('a');

                var ele = $(this);

                if (confirm("Apakah Anda yakin ingin menghapus item ini dari keranjang belanja?")) {
                    $.ajax({
                        url: '{{ route('carts.remove') }}',
                        method: "delete",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        })
    </script>
@endsection
