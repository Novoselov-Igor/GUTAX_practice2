@extends('layouts.app')

@section('title')
    Comments
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="d-flex justify-content-between mb-3">
                <h1>Comments</h1>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Author</th>
                    <th scope="col">Post_id</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <th class="text-center">{{ $loop->index + 1 }}</th>
                        <th class="text-center">{{ $comment->id }}</th>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->status }}</td>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->post_id }}</td>
                        <td>
                            <form method="post" action="{{ route('approveComment') }}" class="text-center">
                                @csrf
                                <input name="comment_id" value="{{ $comment->id }}" hidden>
                                <button type="submit" class="btn"><img
                                        src="{{ asset('public/images/hand-thumbs-up-fill.svg') }}" alt="approve">
                                </button>
                            </form>
                            <div class="text-center">
                                <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><img
                                        src="{{ asset('public/images/trash-fill.svg') }}" alt="delete"></button>
                                <form method="post" action="{{ route('deleteComment') }}">
                                    @csrf
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Вы действительно хотите удалить этот комментарий?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        No
                                                    </button>
                                                    <button type="submit" name="id" value="{{ $comment->id }}"
                                                            class="btn btn-primary">Yes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
