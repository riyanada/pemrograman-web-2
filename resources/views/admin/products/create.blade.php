@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Tambah Product</h2>
            <br />

            @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <br />

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Ini adalah tag CSRF -->
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Produk">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control" placeholder="Harga">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" placeholder="Deskripsi" rows="5" class="form-control"></textarea>
                    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('description');
                    </script>
                </div>
                <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    <input type="file" name="image_url" class="form-control-file" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection