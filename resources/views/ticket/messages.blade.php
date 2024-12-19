@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Messages related to Ticket ID {{ $ticketId }}</h1>

    @if ($messages->isEmpty())
    <p>No messages found for this ticket.</p>
    @else
    <ul>
        @foreach ($messages as $message)
        <li>{{ $message->content }}</li> 
        @endforeach
    </ul>
    @endif
</div>
@endsection