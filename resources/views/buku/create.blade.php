<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Data Buku</h2> <hr>
    <form action="/buku" method="post">
        @csrf
    <input type="text" name="judul" placeholder="Masukan Judul" required > <br>
    <input type="number" name="harga" required> <br>
    <select name="kategori" >
        <option value="">Pilih Kategori</option>
        <option value="Self Improvment">Self Improvment</option>
        <option value="Bacaan">Bacaan</option>
        <option value="Teknologi">Teknologi</option>
    </select>
    <button type="submit">Simpan</button>
    <button type="reset">Refresh</button>
    </form>
</body>
</html>