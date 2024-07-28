@extends('layouts.appStudent')
@section('content')
    @can('create', App\Models\Subject::class)
        <a href="{{ route('subject.create') }}" class="btn btn-primary">Добавить предмет</a>
    @endcan
    <form method="GET" action="{{ route('subject.index') }}">
        <div class="form-group">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Найти предмет" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($subjects->isNotEmpty())
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td><a href="{{ route('subject.show', $subject->id) }}">Посмотреть</a></td>
                    <td>
                        <form action="{{route('subject.destroy', $subject->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('subject.edit',  $subject->id)}}">Edit</a>
                    </td>
                </tr>
                <td>

            @endforeach
                    @else
                        <p>No subject found</p>
        @endif
        </tbody>
    </table>
    {{ $subjects->appends(request()->input())->links() }}

    <a href="{{route('subject.create')}}">Добавить предмет</a>
@endsection
