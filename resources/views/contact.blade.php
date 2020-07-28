@extends('layout')

@section('title', 'Contact Form')

@section('head')
    @parent
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    <form method="POST" action="/submit">
        @csrf
        <div><label>Name</label><input type="text" name="fromName"></div>
        <div><label>Email</label><input type="email" name="fromEmail"></div>
        <div><label>Subject</label>
            <select name="subjectId">
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->description }}</p>
            @endforeach
            </select>
        </div>
        <div><label>Message</label><textarea name="body"></textarea></div>
        {!! htmlFormSnippet() !!}
        <button>Send</button>
    </form>
@endsection
