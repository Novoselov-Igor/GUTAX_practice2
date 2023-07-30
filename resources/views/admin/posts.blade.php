@extends('layouts.app')

@section('title')
    Posts
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="d-flex justify-content-between mb-3">
                <h1>Posts</h1>
                <a href="{{ route('gotoCreatePost') }}" class="btn btn-success d-flex align-items-center px-5"
                   style="font-size: 18px">Create
                    post</a>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="col-md-1"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th class="text-center">{{ $loop->index + 1 }}</th>
                        <th class="text-center">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->tags }}</td>
                        <td>{{ $post->status }}</td>
                        <td class="d-flex flex-column">
                            <div class="text-center">
                                <button class="btn"><img src="{{ asset('public/images/eye-fill.svg') }}" alt="view">
                                </button>
                            </div>
                            <form method="post" action="{{ route('gotoChangePost') }}" class="text-center">
                                @csrf
                                <input name="post_id" value="{{ $post->id }}" hidden>
                                <button type="submit" class="btn"><img
                                        src="{{ asset('public/images/pencil-fill.svg') }}" alt="change">
                                </button>
                            </form>
                            <div class="text-center">
                                <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><img
                                        src="{{ asset('public/images/trash-fill.svg') }}" alt="delete"></button>
                                <form method="post" action="{{ route('deletePost') }}">
                                    @csrf
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Вы действительно хотите удалить этот пост?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        No
                                                    </button>
                                                    <button type="submit" name="id" value="{{ $post->id }}"
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
