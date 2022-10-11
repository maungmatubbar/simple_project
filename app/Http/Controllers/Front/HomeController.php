<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $posts;
    public function home()
    {
        $this->posts = Post::where('status',1)->paginate(5);
        //return $this->posts;
        return view('front.home.home',['posts'=>$this->posts]);
    }

}
