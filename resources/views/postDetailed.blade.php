@extends('layouts.app')

@section('title')
    Подробно
@endsection

@section('content')
    <div class="container">
        <div>
            <div class="d-flex flex-column justify-content-between bg-light text-center mb-3 p-5">
                <div>
                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->content }}</p>
                </div>
                <div class="border-top d-flex">
                    <p>By {{ $post->user->username}}</p>
                    <p class="mx-2">On {{ $post->created_at->toFormattedDateString() }}</p>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>
@endsection
