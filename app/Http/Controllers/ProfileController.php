<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        
        $likedPosts = $query->get()->pluck('post'); //pluck returns the post array without the postlike stuff

        return view('profile.profile', [
            'user' => $user,
            'likedPosts' => $likedPosts,
        ]);
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $imagePath = $request->file('profile_picture')->store('profiles', 'public');

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
