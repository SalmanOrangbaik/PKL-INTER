<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if($barang && $promo)
        Menampilkan Promo untuk {{$barang}} <br>
        Dengan kode promo {{$promo}} <br>
    @elseif($barang)
        Promo untuk {{$barang}}
    @else
        Menampilkan Semua Promo Barang
    @endif
</body>
</html>