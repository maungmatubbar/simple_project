<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'comment' => 'required'
        ]);
        Comment::newComment($request);
        return redirect()->back()->with('message','Comment added successfully');

    }
    public function updateStatus(Request $request)
    {
        Comment::updateStatus($request);
        return response()->json([
            'status' => true,
        ]);
    }
}
