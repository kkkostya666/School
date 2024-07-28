@extends('layouts.appStudent')
@section('content')
    <div class="container">
        <h1>Groups</h1>
        @can('create', App\Models\Group::class)
            <a href="{{ route('group.create') }}" class="btn btn-primary">Добавить группу</a>
        @endcan
        <form method="GET" action="{{ route('group.index') }}">
            <div class="form-group">
                <input type="text" name="query" value="{{ request()->input('query') }}" placeholder="Search for groups by name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <h2>All Groups</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($groups->isNotEmpty())
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td><a href="{{ route('group.show', $group->id) }}">Посмотреть</a></td>
                    <td>
                        <form action="{{ route('group.destroy', $group->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('group.edit',  $group->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
            @else
                <p>No groups found</p>
            @endif
            </tbody>
        </table>

        {{ $groups->appends(request()->input())->links() }}

        <a href="{{ route('group.create') }}">Добавить группу</a>
    </div>
@endsection
