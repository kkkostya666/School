@extends('layouts.appStudent')
@section('content')
    <div>
        <h1>Студент: {{ $student->first_name }} {{ $student->last_name }}</h1>
        <p>Дата рождения: {{ $student->date_of_birth }}</p>
        <p>Андресс: {{ $student->address_array }}</p>
        @if ($student->group)
            <p>Группа: {{ $student->group->name }}</p>
        @else
            <p>Группа: Не указана</p>
        @endif
    </div>
    <a href="{{ route('student.index') }}">Back</a>
    <a href="{{ route('student.edit', $student->id) }}">Edit</a>
    <form action="{{ route('student.destroy', $student->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    @if(auth()->user()->can('pdf'))
        <form action="{{ route('students.exportPdf', $student) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Export to PDF</button>
        </form>
    @endif
    @if (Auth::user()->role == \App\Enums\UserRole::ADMIN)
        @if($student->trashed())
            <form action="{{ route('user.restore', $student->id) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Restore</button>
            </form>
            <form action="{{ route('user.forceDelete', $student->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Force Delete</button>
            </form>
        @else
            <form action="{{ route('user.destroy', $student->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif
    @endif
@endsection


