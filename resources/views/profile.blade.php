
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php $nama = "Salman"?>
    @php $umur = 18 ; @endphp
    
    Ini Profile Saya <?php echo $nama; ?> <br>
    Umur Saya: {{ $umur }}
</body>

</html>
