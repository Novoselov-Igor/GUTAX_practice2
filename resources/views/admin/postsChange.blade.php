@extends('layouts.app')

@section('title')
    Изменение поста
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('changePost') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-end">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{ $post->title }}" required autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content"
                                       class="col-md-4 col-form-label text-md-end">Content</label>

                                <div class="col-md-6">
                                    <textarea id="content" class="form-control"
                                              name="content">{{ $post->content }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tags"
                                       class="col-md-4 col-form-label text-md-end">Tags</label>

                                <div class="col-md-6">
                                    <input id="tags" type="text" class="form-control" name="tags"
                                           value="{{ $post->tags }}" required autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-end">Status</label>

                                <div class="col-md-6">
                                    <select class="form-select" aria-label="status" name="status">
                                        @switch($post->status)
                                            @case(1)
                                            <option value="1" selected>Черновик</option>
                                            <option value="2">Опубликовано</option>
                                            <option value="3">В архиве</option>
                                            @break
                                            @case(2)
                                            <option value="1">Черновик</option>
                                            <option value="2" selected>Опубликовано</option>
                                            <option value="3">В архиве</option>
                                            @break
                                            @case(3)
                                            <option value="1">Черновик</option>
                                            <option value="2">Опубликовано</option>
                                            <option value="3" selected>В архиве</option>
                                            @break
                                            @default
                                            <option value="1">Черновик</option>
                                            <option value="2">Опубликовано</option>
                                            <option value="3">В архиве</option>
                                        @endswitch
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <input type="text" name="user" value="{{ Auth::user()->id }}" hidden>
                                    <input type="text" name="post_id" value="{{ $post->id }}" hidden>
                                    <button type="submit" class="btn btn-primary">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
