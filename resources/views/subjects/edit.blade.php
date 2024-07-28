@extends('layouts.appStudent')
@section('content')
    <div>
        <form action="{{ route('subject.update', $subject) }}" method="POST">
            @csrf
            @method('PUT')
            @include('subjects.form')
            <button type="submit">Update Subject</button>
        </form>
    </div>
@endsection
