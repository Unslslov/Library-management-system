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
<table border="1">
    <thead>
    <tr>
        <th>Имя</th>
        <th>Биография</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $author->name }}</td>
            <td>{{ $author->bio }}</td>
            <td>
                <a href="{{ route('authors.index') }}">Вернутсья на страницу</a>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
