<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $category = Category::all();
        return view('admin.posts.index', compact('posts', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $datipost = Category::all();
        return view('admin.posts.create', compact('datipost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=> "required|string|max:80|unique:posts",
            "content"=> "required|string|max:80|unique:posts",
        ]);

        $addpost = $request->all();

        $slugTmp = Str::slug($addpost['title']);
 
        $count = 1;
        while (Post::where('slug', $slugTmp)->first()){
           $slugTmp = Str::slug($addpost['title'])."-".$count;
           $count ++; 
        };

        $addpost['slug'] = $slugTmp;

        $newPosts = new Post();
        $newPosts->fill($addpost);
        $newPosts->save();

        return redirect()->route('admin.post.show', $newPosts->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        return view('admin.posts.edit', compact('post','category'));
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
        $request->validate([
            "title"=> "required|string|max:100|unique:posts",
            "content"=> "required|string|max:200|unique:posts",
        ]);
        
        $addpost = $request->all();

        if ($post->title == $addpost['title']) {
            $tempSlug = $post->slug;
        } else {
            $tempSlug = Str::of($addpost['title'])->slug("-");
            $count = 1;
            while (Post::where('slug', $tempSlug)->where('id', '!=', $post->id)->first()) {
                $tempSlug = Str::of($addpost['title'])->slug("-") . '-' . $count;
                $count ++;
            }
        }

        $addpost['slug'] = $tempSlug;

        $newPosts = new Post();
        $newPosts->fill($addpost);
        $newPosts->save();

        return redirect()->route('admin.post.show', $newPosts->id);
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
        
        return redirect()->route('admin.post.index');
    }
}
