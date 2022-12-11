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

    <h1>Генератор ПИН</h1>

    <form method="post" action="{{ asset('pin') }}">
        @csrf
        <p>
            <input type="submit" value="Создать ПИН">
        </p>

    </form>

    @if(isset($pin))

        <div>
            Ваш ПИН: <strong>{{ $pin }}</strong>
        </div>

    @endif


</div>

</body>
</html>