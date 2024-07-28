@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('group.store') }}" method="post">
            @csrf
            @include('groups.form')
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
@endsection
