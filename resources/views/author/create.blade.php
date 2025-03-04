<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление автора</title>
</head>
<body>
<h1>Добавление автора</h1>
<form action="{{ route('authors.store') }}" method="POST">
    @csrf
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" required pattern="^[\p{L}\s]+$"
           title="ФИО может содержать только буквы и пробелы"> <br><br>

    <label for="bio">Биография:</label>
    <input type="text" name="bio" id="bio" required> <br><br>
    <button type="submit">Сохранить</button>
</form>
</body>
</html>
