@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('mark.store', $student->id) }}" method="post">
            @csrf
            @include('marks.form')
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
@endsection
