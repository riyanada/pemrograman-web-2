@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row mt-4">
        <div class="col-md-4 offset-md-8">
            <div class="form-group">
                <select name="" id="order_field" class="form-control">
                    <option value="" disabled selected>Urutkan</option>
                    <option value="best_seller">Best Seller</option>
                    <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                    <option value="terbaru">Terbaru</option>
                </select>
            </div>
        </div>
    </div>
        @foreach ($products as $idx => $product)
            @if ($idx == 0 || $idx % 4 == 0)
                <div class="row mt-4">
            @endif
            <div class="col">
                <div class="card">
                    <img src="{{ route('products.image', ['imageName' => $product->image_url]) }}" alt="image"
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', ['id' => $product->id]) }}">{{ $product->name }}</a>
                        </h5>
                        <p class="card-text"> 
                            {{ $product->price }}
                        </p>
                        <a href="{{ route('carts.add', ['id' => $product->id]) }}" class="btn btn-primary">Beli</a>
                    </div>
                </div>
            </div>
            @if ($idx > 0 && $idx % 4 == 3)
    </div>
    @endif
    @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#order_field').change(function(){
            $.ajax({
                type: 'GET',
                url: '/products', // Ubah URL sesuai dengan kebutuhan Anda
                data: {
                    order_by: $(this).val(),
                },
                dataType: 'json',
                success: function(data){
                    var products = '';
                    $.each(data, function(idx, product){
                        if(idx == 0 || idx % 4 == 0){
                            products += '<div class="row mt-4">';
                        }
                        products += `<div class="col">
                                        <div class="card">
                                            <img src="/products/image/${product.image_url}" alt="..." class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="/products/${product.id}">${product.name}</a>
                                                </h5>
                                                <p class="card-text">${product.price}</p>
                                                <a href="/carts/add/${product.id}" class="btn btn-primary">Beli</a>
                                            </div>
                                        </div>
                                    </div>`;
                        if ((idx + 1) % 4 == 0) {
                            products += '</div>'; // Menutup div.row setiap empat elemen
                        }
                    });
                    $('#product-list').html(products);
                },
                error: function(data){
                    alert('Unable to handle request');
                }
            });
        });
    });
</script>

@endsection
