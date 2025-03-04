<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторы</title>
</head>
<body>
<h1>Список авторов</h1>
<a href="{{ route('authors.create') }}">Добавить автора</a>
<table border="1">
    <thead>
    <tr>
        <th>Имя</th>
        <th>Биография</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td>{{ $author->name }}</td>
            <td>{{ $author->bio }}</td>
            <td>
                <a href="{{ route('authors.show', $author->id) }}">Посмотреть</a>
                <a href="{{ route('authors.edit', $author->id) }}">Редактировать</a>
                <form action=" {{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline;">
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
