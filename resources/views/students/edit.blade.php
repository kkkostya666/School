@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('student.update', $student)}}" method="post">
            @csrf
            @method('PUT')
            @include('students.form')
            <button type="submit" class="btn btn-success">Изменить</button>
        </form>
    </div>
@endsection
