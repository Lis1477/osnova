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

    <h1>Категории</h1>

    @foreach($categories->where('parent_id', 0) as $category)

        <div>
            <h3>
                <a href="{{ asset('categories/'.$category->id.'/edit') }}">
                    {{ $category->name }}
                </a>
                <a href="{{ asset('categories/'.$category->id.'?includeProducts=1') }}" style="margin-left: 20px; color: green;">
                    Категория + товары
                </a>
                <a href="{{ asset('categories/'.$category->id.'/products') }}" style="margin-left: 20px; color: green;">
                    Только товары
                </a>
                <a href="{{ asset('categories/'.$category->id.'/products?includeChildren=1') }}" style="margin-left: 20px; color: green;">
                    Категория + товары с вложенными
                </a>
            </h3>
        </div>

        @foreach($categories->where('parent_id', $category->id) as $sub_cat)

            <div>
                <p>
                    &nbsp;&nbsp;- 
                    <a href="{{ asset('categories/'.$sub_cat->id.'/edit') }}">
                        {{ $sub_cat->name }}
                    </a>
                    <a href="{{ asset('categories/'.$sub_cat->id.'?includeProducts=1') }}" style="margin-left: 20px; color: green;">
                        Категория + товары
                    </a>
                    <a href="{{ asset('categories/'.$sub_cat->id.'/products') }}" style="margin-left: 20px; color: green;">
                        Только товары
                    </a>
                    <a href="{{ asset('categories/'.$sub_cat->id.'/products?includeChildren=1') }}" style="margin-left: 20px; color: green;">
                        Категория + товары с вложенными
                    </a>
                </p>
            </div>

            @foreach($categories->where('parent_id', $sub_cat->id) as $sub_sub_cat)

                <div>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;-- 
                        <a href="{{ asset('categories/'.$sub_sub_cat->id.'/edit') }}">
                            {{ $sub_sub_cat->name }}
                        </a>
                        <a href="{{ asset('categories/'.$sub_sub_cat->id.'?includeProducts=1') }}" style="margin-left: 20px; color: green;">
                            Категория + товары
                        </a>
                        <a href="{{ asset('categories/'.$sub_sub_cat->id.'/products') }}" style="margin-left: 20px; color: green;">
                            Только товары
                        </a>
                        <a href="{{ asset('categories/'.$sub_sub_cat->id.'/products?includeChildren=1') }}" style="margin-left: 20px; color: green;">
                            Категория + товары с вложенными
                        </a>
                    </p>
                </div>

            @endforeach

        @endforeach

    @endforeach

</div>

</body>
</html>