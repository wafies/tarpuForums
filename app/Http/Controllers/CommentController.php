<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->paginate(6);

        return view('comments.index', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function create(Post $post)
    {
        return view('comments.create', ['post' => $post]);
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $request->user()->comments()->create([
            'post_id' => $post->id,
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('comments.index', $post)
            ->with('success', 'Your comment was created!');
    }

    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);

        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $updateData = [
            'content' => $validated['content'],
        ];

        $comment->update($updateData);

        return redirect()
            ->route('comments.index', $comment->post)
            ->with('success', 'Your comment was updated!');
    }

    // Delete a comment.
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect()
            ->route('comments.index', $comment->post)
            ->with('success', 'Your comment was deleted.');
    }
}
