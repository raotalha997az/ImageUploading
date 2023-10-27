<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Picture</h1>
 
    @if($img->isNotEmpty())
    <img src="{{ $img[0] }}" alt="Image">
@else
    <p>No image found</p>
@endif
</body>
</html>