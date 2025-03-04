<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Книги</title>
</head>
<body>
<h1>Список книг</h1>
<a href="{{ route('books.create') }}">Добавить книгу</a>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author->name }}</td>
            <td>
                <a href="{{ route('books.show', $book->id) }}">Посмотреть</a>
                <a href="{{ route('books.edit', $book->id) }}">Редактировать</a>
                <form action=" {{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Вы уверены?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
