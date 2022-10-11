<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $posts;
    private $post;
    private $status;
    public function index()
    {
        $this->posts = Post::latest()->get();
        return view('admin.post.index',['posts'=>$this->posts]);
    }


    public function create()
    {
        return view('admin.post.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description'=> 'required'
        ]);
        Post::addNewPost($request);
        return redirect()->back()->with('message','Post created successfully.');
    }


    public function edit($id)
    {
        $this->post = Post::find($id);
        return view('admin.post.edit',['post'=>$this->post]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description'=> 'required'
        ]);
        Post::updatePost($request,$id);
        return redirect('/posts')->with('message','Post updated successfully.');
    }

    public function destroy($id)
    {
        Post::deletePost($id);
        return redirect()->back()->with('message','Post deleted successfully.');
    }
    public function updateStatus(Request $request)
    {
        $this->status = Post::updateStatus($request);
        return response()->json([
            'status' => $this->status,
            'record_id'=> $request->record_id
        ]);
    }
}
