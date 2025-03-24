<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Арендованные книги</title>
</head>
<body>
<h1>Все арендованные книги</h1>
<table border="1">
    <thead>
    <tr>
        <th>Пользователь</th>
        <th>Книга</th>
        <th>Дата аренды</th>
        <th>Дата возврата</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rents as $rent)
        <tr>
            <td>{{ $rent->user->name ?? 'Неизвестно' }}</td>
            <td>{{ $rent->book->title ?? 'Неизвестно' }}</td>
            <td>{{ $rent->rent_date }}</td>
            <td>{{ $rent->due_date ?? 'Не возвращена' }}</td>
            <td>
                @if(now() < \Carbon\Carbon::parse($rent->due_date) && !isset($rent->return_date))
                    <form action="{{ route('rents.return', $rent->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Вернуть</button>
                    </form>
                @else
                    <label>Возвращено</label>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
