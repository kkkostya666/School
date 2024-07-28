@extends('layouts.appStudent')
@section('content')
    @can('create', App\Models\User::class)
        <a href="{{ route('student.create') }}" class="btn btn-primary">Добавить студента</a>
    @endcan
    <form method="GET" action="{{ route('student.index') }}">
        <div class="form-group">
            <label for="date">Start Date:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ request('date_of_birth') }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    @if($students->isNotEmpty())
        <h2>Filtered Users</h2>
        <ul>
            @foreach($students as $student)
                <li>{{ $student->name }} - {{ $student->date_of_birth }}</li>
            @endforeach
        </ul>
    @else
        <p>No users found</p>
    @endif
    <form method="GET" action="{{ route('student.index') }}">
        <div class="form-group">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for groups by name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Surname</th>
            <th>Date Birth</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($students->isNotEmpty())
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->surname ?? 'Отсутстует' }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>{{ $student->group->name ?? 'No Group' }}</td>
                    <td>
                        <a href="{{ route('student.show', $student->id) }}">Посмотреть</a>
                        <a href="{{ route('student.edit', $student) }}">Изменить</a>
                        <a href="{{ route('mark.index', $student->id) }}">Оценки</a>
                        <a href="{{ route('mark.create', $student->id) }}">Добавить оценку</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <p>No users found</p>
        @endif
        </tbody>
    </table>
    {{ $students->appends(request()->input())->links() }}
@endsection
