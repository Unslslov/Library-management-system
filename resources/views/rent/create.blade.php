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
    <form action="{{ route('rents.store', $book->id) }}" method="POST">
        @csrf
        <label for="book_id">{{ $book->title }}</label><br><br>
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <label for="due_date">Аренда на:</label>
        <input type="date" name="due_date" id="due_date" required>
        <button type="submit">Сохранить</button>
    </form>
<body>
</body>
</html>
