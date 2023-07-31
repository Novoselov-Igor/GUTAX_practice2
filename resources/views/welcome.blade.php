@extends('layouts.app')

@section('title')
    Главная страница
@endsection

@section('content')
    <div class="container">
        <div>
            @foreach($posts as $post)
                <div class="d-flex flex-column justify-content-between bg-light text-center mb-3 p-5">
                    <div>
                        <h3>{{ $post->title }}</h3>
                        <p class="overflow-hidden" style="max-height: 15rem">{{ $post->content }}</p>
                        <form method="get" action="{{ route('postsDetailed', ['post' => $post]) }}">
                            <input name="post_id" value="{{ $post->id }}" hidden>
                            <button type="submit" class="btn btn-block"> Continue reading</button>
                        </form>
                    </div>
                    <div class="border-top d-flex">
                        <p>By {{ $post->user->username}}</p>
                        <p class="mx-2">On {{ $post->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div>

        </div>
        {{ $posts->links() }}
    </div>
@endsection
