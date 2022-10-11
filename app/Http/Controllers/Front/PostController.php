<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;
    private $comments;
    public function detail($id)
    {
        $this->post = Post::with('comments')->where(['status'=>1,'id'=>$id])->first();
        $this->comments = Comment::with(['replies'=>function($query){
            $query->where('status',1)->get();
        }])->where(['status'=>1,'post_id'=>$id])->get();
        return view('front.post.detail',['post'=>$this->post,'comments'=>$this->comments]);
    }
}
