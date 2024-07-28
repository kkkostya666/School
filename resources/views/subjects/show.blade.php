@extends('layouts.appStudent')
@section('content')
    <div>Название: {{$subject->name}}
        <div>
            <form action="{{route('subject.destroy', $subject->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
            <div>
                <a href="{{route('subject.index')}}">Back</a>
            </div>
            <a href="{{route('subject.edit',  $subject->id)}}">Edit</a>
        </div>
@endsection
