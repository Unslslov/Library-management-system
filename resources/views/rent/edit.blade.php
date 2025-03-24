<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание аренды</title>
</head>
<h1>Создание аренды для книги: {{ $book->title }}</h1>
    <form action="{{ route('rents.update', $rent->id) }}" method="POST">
        @csrf
        @method('Patch')
        <label for="book_id">{{ $book->title }}</label><br><br>
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <label for="due_date">Аренда на:</label>
        <input type="date" name="due_date" id="due_date"
               value="{{ old('due_date', \Carbon\Carbon::parse($rent->due_date)->addDay(7)->format('Y-m-d')) }}" readonly>
        <button type="submit">Сохранить</button>
    </form>
<body>
</body>
</html>
