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
    <h1>Новаый товар</h1>

    <form method="post" action="{{ asset('products/'.$product->id) }}">
        @csrf
        @method('PUT')
        <p>
            Имя:<br>
            <input type="text" name="name" value="{{ $product->name }}">
        </p>
        <p>
            Родитель:<br>
            <select name="category_id">

                @if($categories->count())

                    @foreach($categories->where('parent_id', 0) as $category)

                        <option value="{{ $category->id }}" disabled>{{ $category->name }}</option>

                        @foreach($categories->where('parent_id', $category->id) as $sub_cat)

                            <option value="{{ $sub_cat->id }}">&nbsp;- {{ $sub_cat->name }}</option>

                            @foreach($categories->where('parent_id', $sub_cat->id) as $sub_sub_cat)

                                <option value="{{ $sub_sub_cat->id }}">&nbsp;&nbsp;-- {{ $sub_sub_cat->name }}</option>

                            @endforeach

                        @endforeach

                    @endforeach

                @endif

            </select>
        </p>
        <p>
            Цена:<br>
            <input type="text" name="price" value="{{ $product->price }}">
        </p>
        <p>
            <input type="submit" value="Обновить">
        </p>
    </form>
</div>

</body>
</html>