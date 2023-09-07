<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        body {
            margin: auto;
            padding: 20px;
            width: 400px;

        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('change-locale') }}">
        @csrf
        <select name="locale" onchange="this.form.submit()">
            <option value="en" {{ app()->isLocale('en') ? 'selected' : '' }}>English</option>
            <option value="kh" {{ app()->isLocale('kh') ? 'selected' : '' }}>ខ្មែរ</option>
        </select>
    </form>
    <div>
        <h1>{{ __('message.welcome') }}</h1>
        <p>{{ __('message.greeting', ['name' => 'John']) }}</p>
    </div>
</body>

</html>
