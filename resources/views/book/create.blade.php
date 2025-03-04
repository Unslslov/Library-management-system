<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить книгу</title>
</head>
<body>
<h1>Добавить книгу</h1>
<form action="{{ route('books.store') }}" method="POST">
    @csrf
    <label for="title">Название:</label>
    <input type="text" name="title" id="title" required> <br><br>

    <label for="author_id">Автор:</label>
    <select name="author_id" id="author_id" required>
        @foreach($authors as $author)
            <option value="{{ $author->id }}">{{$author->name}}</option>
        @endforeach
    </select><br><br>

    <label for="published_at">Дата публикации:</label>
    <input type="date" name="published_at" id="published_at" required> <br><br>
    <button type="submit">Сохранить</button>
</form>
</body>
</html>
