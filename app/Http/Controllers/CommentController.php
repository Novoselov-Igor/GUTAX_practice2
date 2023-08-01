<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin.comments', ['comments' => Comment::all()]);
    }

    public function gotoDetailed(Request $request)
    {
        return view('postDetailed', ['post' => Post::find($request->input('post_id'))]);
    }

    public function createComment(Request $request)
    {
        $validatedData = $request->validate([
            'author' => ['required', 'string', 'max:128'],
            'content' => ['required', 'string', 'max:128'],
            'status' => ['required']
        ]);

        Comment::create([
            'content' => $validatedData['content'],
            'status' => $validatedData['status'],
            'author' => $validatedData['author'],
            'post_id' => $request->input('id')
        ]);

        return response()->json(['success' => 'comment successfully created']);
    }

    public function approveComment(Request $request)
    {
        Comment::find($request->input('comment_id'))->update([
            'status' => 1
        ]);

        return redirect()->route('comments');
    }

    public function deleteComment(Request $request)
    {
        Comment::find($request->input('id'))->delete();
        return redirect()->route('comments');
    }

}
