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

    <h1>Генератор пароля</h1>

    <form method="post" action="{{ asset('pass') }}">
        @csrf
        <p>
            Количество символов:
            <input type="number" name="lenght" value="8" min="8">
        </p>
        <p>
            <input type="submit" value="Создать">
        </p>

    </form>

    @if(isset($pass))

        <div>
            Ваш пароль: <strong>{{ $pass }}</strong>
        </div>

    @endif
        
</div>

</body>
</html>