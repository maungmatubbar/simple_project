<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    private static $comment;
    public static function newComment($request)
    {
        self::$comment          = new Comment();
        self::$comment->user_id = Auth::user()->id;
        self::$comment->post_id = $request->post_id;
        self::$comment->name    = $request->name;
        self::$comment->comment = $request->comment;
        self::$comment->save();
    }
    public function replies()
    {
        return $this->hasMany(Reply::class)->where('parent_id',0);
    }
    public static function updateStatus($request)
    {
        self::$comment = Comment::find($request->commentId);
        self::$comment->status = 0;
        self::$comment->save();

    }
}
