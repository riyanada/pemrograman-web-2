@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Alamat Pengiriman</span>
                    </h2>
                    <p>
                        {{ $orders->shipping_address }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Kode Pos</span>
                    </h2>
                    <p>
                        {{ $orders->zip_code }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Harga Total</span>
                    </h2>
                    <p>
                        {{ $orders->total_price }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($orders->orderItems as $orderItem)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">
                                    <img src="{{ route('products.image', ['imageName' => $orderItem->product->image_url]) }}" width="100" height="100" class="img-responsive">
                                </div>
                                <div class="col-sm-9">
                                    <a href="{{ route('products.show', ['id' => $orderItem->product->id]) }}">
                                        <h4 class="nomargin">
                                            {{ $orderItem->product->name }}
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">
                            {{ $orderItem->price }}
                        </td>
                        <td data-th="Quantity">
                            {{ $orderItem->quantity}}
                        </td>
                        <td data-th="Subtotal">
                            {{ $orderItem->price *  $orderItem->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection