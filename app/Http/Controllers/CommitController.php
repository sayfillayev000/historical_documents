<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommitController extends Controller
{
    public function store(CommentRequest $request)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'history_id' => $request->history_id,
            'content' => $request->content
        ]);

        return back()->with('success', 'Izoh muvaffaqiyatli qo\'shildi.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() === $comment->user_id || Auth::user()->hasRole('admin')) {
            $comment->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
        return back()->with('success', 'Izoh muvaffaqiyatli o\'chirildi.');
    }
}
