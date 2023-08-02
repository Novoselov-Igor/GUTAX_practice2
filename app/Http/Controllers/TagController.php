<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tagFilter(Request $request)
    {
        return view('welcome', ['posts' => Post::orderBy('created_at', 'desc')
            ->where('tags', 'like', '%' . $request->input('tag') . '%')
            ->where('status', Post::STATUS_PUBLISHED)
            ->orWhere('status', Post::STATUS_ARCHIVED)
            ->paginate(10),
            'comments' => Comment::orderby('created_at', 'desc')
                ->where('status', Comment::STATUS_APPROVED)
                ->limit(5)
                ->get(),
            'tags' => Tag::all()]);
    }

    public function createOrUpdateTag($tags, $postStatus = Post::STATUS_DRAFT)
    {
        $tags = $this->splitTags($tags);
        foreach ($tags as $tag) {
            $tagDB = Tag::firstWhere('name', $tag);
            if ($tagDB !== null && (int)$postStatus !== Post::STATUS_DRAFT) {
                $frequency = (int)$tagDB->frequency + 1;
                Tag::find($tagDB->id)->update([
                    'frequency' => $frequency
                ]);
            } elseif ((int)$postStatus !== Post::STATUS_DRAFT) {
                Tag::create([
                    'name' => $tag
                ]);
            }
        }
    }

    protected function splitTags($tags)
    {
        return preg_split('/[\s,]+/', $tags);
    }

    public function deleteTag($tags)
    {
        $tags = $this->splitTags($tags);
        foreach ($tags as $tag) {
            $tagDB = Tag::firstWhere('name', $tag);
            if ($tagDB !== null && $tagDB->frequency > 0) {
                $frequency = (int)$tagDB->frequency - 1;
                Tag::find($tagDB->id)->update([
                    'frequency' => $frequency
                ]);
            }
        }
    }
}
