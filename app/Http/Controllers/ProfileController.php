<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use App\Models\CommentLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $users = $query
            ->latest()
            ->paginate(6);

        return view('profile.index', [
            'users' => $users,
        ]);
    }

    public function specific(User $user)
    {
        return view('profile.specific', [
            'user' => $user,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $query = PostLike::query();
        $query->where('user_id', $user->id);
        
        $likedPosts = $query->with('post')->get()->pluck('post'); //pluck returns the post array without the postlike stuff
        
        $query = CommentLike::query();
        $query->where('user_id', $user->id);
        
        $likedComments = $query->with('comment.post')->get()->pluck('comment');

        return view('profile.profile', [
            'user' => $user,
            'likedPosts' => $likedPosts,
            'likedComments' => $likedComments,
        ]);
    }
    public function destroy(User $user, Request $request){
        // AUTHORIZATION:
        // Check the "delete" ability in UserPolicy before deleting.
        Gate::authorize('delete', $user);

        // Remove the image file from storage.
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $user->posts->each(fn ($post) => Storage::disk('public')->delete($post->image_path));
        
        if($request->check){
            Auth::logout();

            // Invalidate the old session.
            $request->session()->invalidate();

            // Create a new CSRF token.
            $request->session()->regenerateToken();
            // Remove the user from the database.
            $user->delete();
        
            return redirect()
                ->route('posts.index')
                ->with('success', 'Jūsu konts tika dzēsts.');
        }
        $user->delete();
        
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Konts tika dzēsts.');
    }
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $imagePath = $request->file('profile_picture')->store('profiles', 'public');

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $user->profile_picture = $imagePath;
        $user->save();
        return redirect()->route('profile');
    }

    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $updateData = [
            'name' => $validated['name'],
        ];
        $user->update($updateData);

        return redirect()->route('profile');
    }

    public function updateDesc(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $user = Auth::user();

        $updateData = [
            'description' => $validated['description'],
        ];
        $user->update($updateData);

        return redirect()->route('profile');
    }
}
