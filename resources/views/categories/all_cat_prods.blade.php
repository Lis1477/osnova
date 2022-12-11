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

    <h1>Все категории с товарами</h1>

    @foreach($categories as $category)

        <div>
            <h3>{{ $category['name'] }}</h3>
        </div>

        @if($category['products']->count())

            @foreach($category['products'] as $product)

                <div>
                    <p>&nbsp;&nbsp;- {{ $product->name }} - {{ $product->price }} руб</a></p>
                </div>

            @endforeach

        @endif

    @endforeach

</div>

</body>
</html>