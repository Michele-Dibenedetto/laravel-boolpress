<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        $categories = Category::all();
        $data = [
            "posts" => $posts,
            "categories" => $categories,
        ];
        return view("guest.posts.posts", $data);
    }

    public function show($slug) {
        $post = Post::where("slug", $slug)->first();
        if ($post) {
            return view("guest.posts.post", compact("post"));
        }
        abort(404);
    }
}
