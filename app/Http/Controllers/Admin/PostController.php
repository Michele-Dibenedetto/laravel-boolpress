<?php

namespace App\Http\Controllers\Admin;

use illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "tags" => Tag::all(),
            "categories" => Category::all()
        ];
        return view("admin.posts.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();

        $request->validate([
            "titolo" => "required",
            "testo" => "required"
        ]);
        $newPost = new Post;
        $newPost->fill($post);
        $slug = Str::slug($newPost->titolo, "-");
            $slug_tmp = Post::where("slug", $slug)->first();
            $c = 1;
            while ($slug_tmp) {
                $slug = $slug . "-" . $c;
                $c++;
                $slug_tmp = Post::where("slug", $slug)->first();
            }
        $newPost->slug = $slug;

        $newPost->user_id = Auth::id();
        // $newPost->category_id = Auth::category();
        $newPost->save();

        if (array_key_exists("tags", $post)) {
            $newPost->tags()->sync($post["tags"]);
        }

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            "post" => $post,
            "tags" => Tag::all(),
            "category" => Category::all()
        ];
        return view("admin.posts.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            "post" => $post,
            "tags" => Tag::all()
        ];
        return view("admin.posts.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $request->validate([
            "titolo" => "required",
            "testo" => "required"
        ]);

        if ($data["titolo"] != $post->titolo) {
            $slug = Str::slug($data["titolo"], "-");
            $slug_tmp = Post::where("slug", $slug)->first();
            $c = 1;
            while ($slug_tmp) {
                $slug = $slug . "-" . $c;
                $c++;
                $slug_tmp = Post::where("slug", $slug)->first();
            }
        $data["slug"] = $slug;
        }

        $post->update($data);

        if (array_key_exists("tags", $data)) {
            $post->tags()->sync($data["tags"]);
        }

        return redirect()->route("posts.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("posts.index");
    }
}
