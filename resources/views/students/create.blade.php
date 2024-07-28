@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('student.store') }}" method="post">
            @csrf
            @include('students.form')
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
@endsection
