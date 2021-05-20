<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view("posts.posts", compact("posts"));
    }

    public function show($slug) {
        $post = Post::where("slug", $slug)->first();
        if ($post) {
            return view("posts.post", compact("post"));
        }
        abort(404);
    }
}
