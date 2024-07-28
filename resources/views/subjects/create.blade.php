@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('subject.store') }}" method="post">
            @csrf
            @include('subjects.form')
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
@endsection
