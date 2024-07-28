<x-mail::message>
    # Hello, {{ $userName }}

    Here are your grades for all subjects:

    @if($subjects->isEmpty())
        You are not enrolled in any subjects.
    @else
        @foreach ($subjects as $subject)
            - **{{ $subject->name }}**: {{ $subject->pivot->mark }}
        @endforeach
    @endif

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
