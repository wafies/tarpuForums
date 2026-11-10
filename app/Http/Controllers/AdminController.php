<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function dashboard()
    {
        // GATE:
        // Check the named "view-admin-dashboard" Gate defined in
        // AppServiceProvider. Only administrators pass this check.
        Gate::authorize('view-admin-dashboard');

        
        $userCount = User::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        $latestPost = Post::latest()->first();
        $latestUser = User::latest()->first();
        $latestComment = Comment::latest()->first();
        $reports = Report::with(['user', 'post'])->latest()->get();
        $commentReports = CommentReport::with(['comment.user', 'comment.post', 'user'])->latest()->get();

        return view('admin.dashboard', compact('userCount', 'postCount', 'commentCount', 'latestPost', 'latestUser', 'latestComment', 'reports', 'commentReports'));
    }
}
