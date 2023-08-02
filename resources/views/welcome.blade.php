@extends('layouts.app')

@section('title')
    Главная страница
@endsection

@section('content')
    <div class="container d-flex">
        <div class="col-md-9">
            @foreach($posts as $post)
                <div class="d-flex flex-column justify-content-between bg-light text-center mb-3 p-5">
                    <div>
                        <h3>{{ $post->title }}</h3>
                        <p class="overflow-hidden" style="max-height: 15rem">{{ $post->content }}</p>
                        <form method="get" action="{{ route('postsDetailed', ['post' => $post]) }}">
                            <input name="post_id" value="{{ $post->id }}" hidden>
                            <button type="submit" class="btn btn-block">Continue reading</button>
                        </form>
                    </div>
                    <div class="border-top d-flex justify-content-between">
                        <div class="d-flex">
                            <p>By {{ $post->user->username}}</p>
                            <p class="mx-2">On {{ $post->created_at->toFormattedDateString() }}</p>
                        </div>
                        <div>
                            <p>Tags: {{ $post->tags }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3 mx-3">
            <div>
                <h5 class="text-center bg-light m-0 py-2">Last comments</h5>
                @foreach($comments as $comment)
                    <div class="bg-light py-3 px-4">
                        <h6 class="text-center">Post - {{ $comment->post->title }}</h6>
                        <div class="d-flex justify-content-between border-bottom mb-2">
                            <h6>{{ $comment->author }}</h6>
                            <p class="text-secondary m-0 p-0">{{ $comment->created_at->toFormattedDateString() }}</p>
                        </div>
                        <div>
                            <p style="word-break: break-all; white-space: normal">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                <h5 class="text-center bg-light m-0 py-2">Tags</h5>
                @foreach($tags as $tag)
                    @if($tag->frequency > 0)
                        <div class="bg-light d-flex justify-content-between py-2 px-4">
                            <form method="get" action="{{ route('gotoFiltered', ['tag' => $tag->name]) }}">
                                <input name="tag" value="{{ $tag->name }}" hidden>
                                <button type="submit" class="btn m-0 p-0">{{ $tag->name }}</button>
                            </form>
                            <p class="m-0">({{ $tag->frequency }})</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        {{ $posts->links() }}
    </div>
@endsection
