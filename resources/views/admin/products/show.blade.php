@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Produk</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{!! strip_tags($product->description) !!}</td>
                            </tr>

                            </tr>
                            <tr>
                                <th>Gambar Produk</th>
                                <td><img src="{{ $product->image_url }}" alt="Gambar Produk">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection