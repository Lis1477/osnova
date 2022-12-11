<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

<div style="display: flex;">
<div style="flex: 0 0 250px; border-right: solid;">
    @include('includes.menu')
</div>

<div style="flex-grow: 1; padding-left: 20px;">

    <h1>Категория <strong>{{ $category }}</strong></h1>

    @foreach($products as $product)

        <p>{{ $product->name }}</p>

    @endforeach

</div>

</body>
</html>