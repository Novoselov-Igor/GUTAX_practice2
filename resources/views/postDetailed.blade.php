@extends('layouts.app')

@section('title')
    {{ $post->title }}
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
            <form id="commentForm">
                <div class="card">
                    <div class="card-body p-2">
                        <h5>Comment</h5>
                        <textarea class="form-control" id="comment_content" name="comment_content"
                                  aria-label="comment"></textarea>
                    </div>
                    <div class="d-flex justify-content-end p-1">
                        @if(Auth::user() !== null)
                            <button type="submit" id="submit" class="btn btn-primary px-5">Send</button>
                        @else
                            <p class="m-0 p-2">You must be logged in order to leave comments!</p>
                            <button type="button" class="btn btn-primary px-5" disabled>Send</button>
                        @endif
                    </div>
                </div>
            </form>
            @if($comments !== null)
                <div>
                    @foreach($comments as $comment)
                        @if($comment->status === 1 && $comment->post_id === $post->id)
                            <div class="">
                                <h6>{{ $comment->author }}</h6>
                                <span></span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if(Auth::user() !== null)
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $('#commentForm').on('submit', function (event) {
            event.preventDefault();

            let content = $('#comment_content').val();
            let status = 0;
            let author = "{{ Auth::user()->username }}";
            let post_id = "{{ $post->id }}";

            $.ajax({
                url: "/comment/created",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    content: content,
                    status: status,
                    author: author,
                    id: post_id
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });
    </script>
    @endif
@endsection
