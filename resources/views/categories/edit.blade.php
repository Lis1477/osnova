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
    <h1>Редактировать категорию</h1>

    <form method="post" action="{{ asset('categories/'.$category->id) }}">
        @csrf
        @method('PUT')
        <p>
            Имя:<br>
            <input type="text" name="name" value="{{ $category->name }}">
        </p>
        <p>
            Родитель:<br>
            <select name="parent_id">

                <option value="0">Главная</option>

                @if($categories->count())

                    @foreach($categories->where('parent_id', 0)->where('id', '!=', $category->id) as $cat)

                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>

                        @foreach($categories->where('parent_id', $cat->id)->where('id', '!=', $category->id) as $sub_cat)

                            <option value="{{ $sub_cat->id }}">&nbsp;- {{ $sub_cat->name }}</option>

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