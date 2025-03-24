<body>
<h1>Список книг</h1>
<div>
    <a href="{{ route('books.index') }}">Вернуться в СССР</a>
</div>
@if(Auth::user()->unreadNotifications->count())
    <div>
        <h2>Уведомления</h2>
        <ul>
            @foreach(Auth::user()->unreadNotifications as $notification)
                <li>
                    {{ $notification->data['book_id'] }} - Срок возврата: {{ $notification->data['due_date'] }}
                    <form action="{{ route('rents.delete.notification', [$notification->data['rent_id'], $notification->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Продлить книгу</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endif

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
                <a href="{{ route('rents.create', $book->id) }}">Арендовать книгу</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
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
