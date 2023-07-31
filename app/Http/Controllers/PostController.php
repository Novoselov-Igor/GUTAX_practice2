<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts', ['posts' => Post::all()]);
    }

    public function gotoDetailed(Request $request)
    {
        return view('postDetailed', ['post' => Post::find($request->input('post_id'))]);
    }

    public function gotoCreate()
    {
        return view('admin.postsCreation');
    }

    public function gotoChange(Request $request)
    {
        return view('admin.postsChange', ['post' => Post::find($request->input('post_id'))]);
    }

    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:128'],
            'content' => ['required'],
            'status' => ['required', 'integer', 'min:1', 'max:3'],
            'tags' => ['regex:/^[\w\s,]+$/'],
            'user' => ['required']
        ]);

        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'status' => $validatedData['status'],
            'tags' => Tag::array2string(array_unique(Tag::string2array($validatedData['tags']))),
            'author_id' => $validatedData['user']
        ]);

        return redirect()->route('posts');
    }
    public function changePost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:128'],
            'content' => ['required'],
            'status' => ['required', 'integer', 'min:1', 'max:3'],
            'tags' => ['regex:/^[\w\s,]+$/'],
            'user' => ['required']
        ]);

        Post::find($request->input('post_id'))->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'status' => $validatedData['status'],
            'tags' => Tag::array2string(array_unique(Tag::string2array($validatedData['tags']))),
            'author_id' => $validatedData['user']
        ]);

        return redirect()->route('posts');
    }
    public function deletePost(Request $request)
    {
        Post::find($request->input('id'))->delete();
        return redirect()->route('posts');
    }
}
