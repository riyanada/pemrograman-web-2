@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="{{ route('products.image', ['imageName' => $product->image_url]) }}" alt="..." class="card-img-top">
        </div>

        <div class="col-md-3">
            <h3>
                {{ $product->name }}
            </h3>
            <h4>
                {{ $product->price }}
            </h4>
            <div class="mt-4">
                <a href="{{ route('carts.add', ['id' => $product->id]) }}" class="btn btn-primary">
                    Beli Sekarang!
                </a>
            </div>
            <div class="mt-2">
                <a href="https://facebook.com/sharer/sharer.php?u={{ route('products.show', ['id' => $product['id']]) }}" class="social-button" target="_blank">
                    Share Facebook
                </a> |
                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('products.show', ['id' => $product['id']]) }}" class="social-button" target="_blank">
                    Share Twitter
                </a> |
                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('products.show', ['id' => $product['id']]) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button" target="_blank">
                    Share LinkedIn
                </a> |
                <a href="https://wa.me/?text={{ route('products.show', ['id' => $product['id']]) }}" class="social-button" target="_blank">
                    Share WhatsApp
                </a>
            </div>
            <div class="mt-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#description" class="nav-link active" role="tab" data-toogle="tab">Deskripsi</a>
                    </li>
                    <li class="nav-item">
                        <a href="#review" role="tab" data-toogle="tab" class="nav-link">Review</a>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content mt-2">
                    <div class="tab-pane fade in active show" id="description" role="tabpanel">
                        {!! $product->description !!}
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="review">
                        Content untuk review disini
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection