<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Laravel</title>
</head>

<body>
    <h3>Data Pegawai</h3>
    <a href="/pegawai">Kembali</a>
    <br>
    <br>

    <form action="/pegawai/store" method="post">
        {{ csrf_field() }}
        Nama <input type="text" name="nama" required> <br>
        Jabatan <input type="text" name="jabatan" required> <br>
        Umur <input type="text" name="umur" required> <br>
        Alamat <textarea name="alamat" cols="30" rows="10" required></textarea> <br>
        <input type="submit" value="Simpan Data">
    </form>
</body>

</html>