<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('user', 'likes');

        if ($request->category) {
            $query->where('category', $request->category);
        }
        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }
        if ($request->sort) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'most_commented':
                    // withCount adds a comments_count attribute to each post, which we can then order by.
                    $query->withCount('comments')->orderBy('comments_count', 'desc');
                    break;
                case 'least_commented':
                    $query->withCount('comments')->orderBy('comments_count', 'asc');
                    break;
                case 'most_liked':
                    $query->withCount('likes')->orderBy('likes_count', 'desc');
                    break;
                case 'least_liked':
                    $query->withCount('likes')->orderBy('likes_count', 'asc');
                    break;
            }
        }

        $posts = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }
    //this probably should be its own controller but im lazy
    public function toggleLike(Post $post)
    {
        //checks if user has already liked this post
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();

            return back();
        }

        $post->likes()->create(['user_id' => auth()->id()]);

        return back();
    }
    // Show the form for creating a post.
    public function create()
    {
        return view('posts.create');
    }

    // Save a new post.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Dārzniecība,Zveja,Zinātniski,RP,Jebkas',
            'image' => 'required|image|max:2048',
        ]);

        // Save the uploaded image to storage/app/public/posts.
        $imagePath = $request->file('image')->store('posts', 'public');

        // GATEWAY TO OWNERSHIP:
        // Creating through the logged-in user's posts relationship
        // automatically sets user_id to the current user's ID.
        $request->user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'image_path' => $imagePath,
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Your post was created!');
    }

    // Show the edit form for a post.
    public function edit(Post $post)
    {
        // AUTHORIZATION:
        // Gate::authorize checks the "update" ability.
        // Laravel sends this check to PostPolicy::update().
        // A user who does not own the post receives a 403 response.
        Gate::authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    // Update an existing post.
    public function update(Request $request, Post $post)
    {
        // AUTHORIZATION:
        // Check ownership (or admin permissions) before changing the post.
        Gate::authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Dārzniecība,Zveja,Zinātniski,RP,Jebkas',
            'image' => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
        ];

        $oldImagePath = $post->image_path;
        $newImageUploaded = $request->hasFile('image');

        // Store a replacement image first, if one was uploaded.
        if ($newImageUploaded) {
            $updateData['image_path'] = $request->file('image')
                ->store('posts', 'public');
        }

        $post->update($updateData);

        // Delete the old image after updating the post.
        if ($newImageUploaded) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()
            ->route('posts.index')
            ->with('success', 'Your post was updated!');
    }

    // Delete a post.
    public function destroy(Post $post)
    {
        // AUTHORIZATION:
        // Check the "delete" ability in PostPolicy before deleting.
        Gate::authorize('delete', $post);

        // Remove the image file from storage.
        Storage::disk('public')->delete($post->image_path);

        // Remove the post from the database.
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Your post was deleted.');
    }
}
