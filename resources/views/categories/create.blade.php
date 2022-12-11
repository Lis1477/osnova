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
    <h1>Новая категория</h1>

    <form method="post" action="{{ asset('categories') }}">
        @csrf
        <p>
            Имя:<br>
            <input type="text" name="name">
        </p>
        <p>
            Родитель:<br>
            <select name="parent_id">

                <option value="0">Главная</option>

                @if($categories->count())

                    @foreach($categories->where('parent_id', 0) as $category)

                        <option value="{{ $category->id }}">{{ $category->name }}</option>

                        @foreach($categories->where('parent_id', $category->id) as $cab_cat)

                            <option value="{{ $cab_cat->id }}">&nbsp;- {{ $cab_cat->name }}</option>

                        @endforeach

                    @endforeach

                @endif

            </select>
        </p>
        <p>
            <input type="submit" value="Сохранить">
        </p>
    </form>
</div>

</body>
</html>