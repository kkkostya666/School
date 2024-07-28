@extends('layouts.appStudent')
@section('content')
    <h1>Group: {{ $group->name }}</h1>
    <table border="1">
        <thead>
        <tr>
            <th>Student</th>
            @foreach($subjectStudent as $subject)
                <th>{{ $subject->name }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($allStudents as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
                @foreach($subjectStudent as $subject)
                    <td class="{{ $user->grade_class }}">
                        {{ $user->subjects->where('id', $subject->id)->first()?->pivot->mark ?? '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
        <tr>
            <td><strong>Средний балл</strong></td>
            @foreach ($subjectStudent as $subject)
                <td>
                    {{ number_format($subject->users->pluck('pivot.mark')->avg(), 2) }}
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>

    </table>
        <h2>Отличники</h2>
        <ul>
            @foreach($greatStudents as $student)
                <li>{{ $student->first_name }} {{ $student->last_name }}</li>
            @endforeach
        </ul>
        <h2>Хорошисты</h2>
        <ul>
            @foreach($goodStudents as $student)
                <li>{{ $student->first_name }} {{ $student->last_name }}</li>
            @endforeach
        </ul>
@endsection

