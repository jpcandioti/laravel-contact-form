@extends('layout')

@section('title', 'Contact Form')

@section('head')
    @parent
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    @if ($success)
        <p>Thanks!</p>
    @else
        <p>Error!</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
@endsection
