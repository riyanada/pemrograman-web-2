@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Produk</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" class="form-control" name="description" required>{{ $product->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection