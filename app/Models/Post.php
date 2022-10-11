<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    private static $post;
    public static function addNewPost($request)
    {
        self::$post              = new Post();
        self::$post->title       = $request->title;
        self::$post->description = $request->description;
        self::$post->post_by     = Auth::guard('admin')->user()->name;
        self::$post->save();
    }
    public static function updatePost($request,$id)
    {
        self::$post              = Post::find($id);
        self::$post->title       = $request->title;
        self::$post->description = $request->description;
        self::$post->post_by     = Auth::guard('admin')->user()->name;
        self::$post->save();
    }
    public static function deletePost($id)
    {
        self::$post = Post::find($id);
        self::$post->delete();
    }
    public static function updateStatus($request)
    {
        self::$post = Post::find($request->record_id);
        if($request->status == 'active')
        {
            self::$post->status = 0;
            self::$post->save();
        }
        else
        {
            self::$post->status = 1;
            self::$post->save();
        }
        return self::$post->status;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }
}
