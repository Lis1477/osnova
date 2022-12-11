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

    @if ($message = Session::get('success'))
        <div style="color: red;">
            <p>{{ $message }}</p>
        </div>
    @endif

    <h1>Список товаров</h1>

    @foreach($products as $product)

        <div>
            <a href="{{ asset('products/'.$product->id.'/edit') }}" title="Редактировать">
                {{ $product->name }}
            </a>
            <form method="post" action="{{ asset('products/'.$product->id) }}" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <input type="submit" value="Удалить">
            </form>
        </div>

    @endforeach

</div>

</body>
</html>