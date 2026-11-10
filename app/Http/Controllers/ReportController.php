<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Report;
use App\Models\CommentReport;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function report(Post $post, Request $request)
    {
        // Same as likes
        $report = $post->reports()->where('user_id', auth()->id())->first();

        $validatedData = $request->validate([
            'reason' => 'required|string|max:255',
        ]);
        if (!$report) {
            $post->reports()->create(['user_id' => auth()->id(), 'reason' => $validatedData['reason']]);
        }

        return back();
    }
    public function destroy(Report $report){
        //only admins can delete reports
        Gate::authorize('delete', $report);
        $report->delete();
        return redirect(route('admin.dashboard'));
    }
    //same but for comment reports
    public function destroyCommentReport(CommentReport $report){
        Gate::authorize('delete', $report);
        $report->delete();
        return redirect(route('admin.dashboard'));
    }
}
