<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Request $request, Post $post)
    {
        $sort = $request->query('sort', 'newest');

        // withCount/withExists give each comment likes_count,
        // liked_by_user and reported_by_user without extra queries per comment.
        $query = $post->comments()
            ->with('user')
            ->withCount('likes')
            ->withExists([
                'likes as liked_by_user' => fn ($query) => $query->where('user_id', auth()->id()),
                'reports as reported_by_user' => fn ($query) => $query->where('user_id', auth()->id()),
            ]);

        // Same sorting pattern as PostController::index, but with likes instead of comments.
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'most_liked':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'least_liked':
                $query->orderBy('likes_count', 'asc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        // withQueryString keeps the sort when clicking pagination links.
        $comments = $query->paginate(6)->withQueryString();

        return view('comments.index', [
            'post' => $post,
            'comments' => $comments,
            'sort' => $sort,
        ]);
    }

    // Same as PostController::toggleLike, but for comments.
    public function toggleLike(Comment $comment)
    {
        // Checks if user has already liked this comment.
        $like = $comment->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();

            return back();
        }

        $comment->likes()->create(['user_id' => auth()->id()]);

        return back();
    }

    // Same as ReportController::report, but for comments.
    public function report(Comment $comment, Request $request)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // firstOrCreate = the check-then-create pattern, but atomic.
        // The unique constraint on (comment_id, user_id) is the backstop.
        $comment->reports()->firstOrCreate(
            ['user_id' => auth()->id()],
            ['reason' => $validatedData['reason']],
        );

        return back();
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
