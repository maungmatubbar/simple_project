<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    use HasFactory;
    public static $reply;
    public static function newReply($request)
    {
        self::$reply             = new Reply();
        self::$reply->parent_id  = $request->parent_id;
        self::$reply->comment_id = $request->comment_id;
        self::$reply->user_id    = Auth::user()->id;
        self::$reply->name       = Auth::user()->name;
        self::$reply->message    = $request->message;
        self::$reply->save();

    }
    public function subreplies()
    {
        return $this->hasMany(Reply::class,'parent_id')->where('status',1);
    }
    public static function updateStatus($request)
    {
        self::$reply = Reply::find($request->replyId);
        self::$reply->status = 0;
        self::$reply->save();
    }
}
