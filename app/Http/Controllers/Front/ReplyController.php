<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);
        Reply::newReply($request);
        return redirect()->back()->with('message','Reply added successfully');
    }
    public function updateStatus(Request $request)
    {
        Reply::updateStatus($request);
        return response()->json([
            'status' =>true
        ]);
    }
}
