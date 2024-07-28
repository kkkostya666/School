@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('group.update', $group) }}" method="POST">
            @csrf
            @method('PUT')
            @include('groups.form')
            <button type="submit">Update Subject</button>
        </form>
    </div>
@endsection
