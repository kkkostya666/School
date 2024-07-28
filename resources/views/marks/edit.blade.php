@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('mark.update', ['student' => $student, 'subject' => $subject]) }}" method="post">
            @csrf
            @include('marks.form')
            @method('PUT')
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
