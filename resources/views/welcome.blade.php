@extends('layouts.app')

@section('title')
    Main page
@endsection

@section('content')
    <div class="container">
        <div>
            @foreach($posts as $post)
                <div class="d-flex flex-column justify-content-between bg-light text-center mb-3 p-5" style="height: 30rem">
                    <div>
                    <h3>{{ $post->title }}</h3>
                    <p class="overflow-hidden">{{ $post->content }}</p>
                    <button class="btn btn-link">see more</button>
                    </div>
                    <div class="border-top d-flex">
                        <p>By {{ $post->user->username}}</p>
                        <p class="mx-2">On {{ $post->updated_at->toFormattedDateString() }}</p>
                    </div>

                </div>
            @endforeach
        </div>
        <div>

        </div>
        {{ $posts->links() }}
    </div>
@endsection
