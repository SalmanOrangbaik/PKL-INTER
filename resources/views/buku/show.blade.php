<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    ID:{{$buku['id']}} <br>
    Judul:{{$buku['judul']}} <br>
    Harga:{{number_format($buku['harga'])}} <br>
    kategori:{{$buku['kategori']}}
</body>
</html>