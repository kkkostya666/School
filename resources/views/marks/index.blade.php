@extends('layouts.appStudent')
@section('content')
    <div>
        <h1>Оценки студента: {{ $student->first_name }} {{ $student->last_name }}</h1>
        @can('manage-grades', $student)
            <a href="{{ route('mark.create' ,['student' => $student->id]) }}">Add Mark</a>
        @endcan
        <table>
            <thead>
            <tr>
                <th>Предмет</th>
                <th>Оценка</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @can('view-grades', $student)
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->pivot->mark }}</td>
                    <td>
                        @can('edit-grade', [$student, $subject->id])
                            <a href="{{ route('mark.edit', ['student' => $student->id, 'subject' => $subject->id]) }}">Изменить</a>
                        @endcan
                        @can('delete-grade', [$student, $subject->id])
                        <form action="{{ route('mark.destroy', [$student->id, $subject->id]) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                            @endcan
                    </td>
                </tr>
            @endforeach
                @endcan
            </tbody>
        </table>
    </div>
@endsection


