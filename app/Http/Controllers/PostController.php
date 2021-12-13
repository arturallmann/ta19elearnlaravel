<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PostBelongsToAuth;
use App\Http\Requests\CreatePostRequest;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function apiPosts(){
        return Post::with('images')->paginate();
    }


    public function __construct(){
        $this->middleware(PostBelongsToAuth::class)->only(['show', 'edit','update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = auth()->user()->posts()->paginate();
        return response()->view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request)
    {
//        $validated = $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);
        $post = new Post($request->validated());
        $post->user()->associate(auth()->user());
        $post->save();
        if($request->validated()['image']) {
            foreach ($request->validated()['image'] as $image) {
                /** @var UploadedFile $image */
                $path = $image->store('public');
                $img = new Image();
                $img->path = Storage::url($path);
                $img->post()->associate($post);
                $img->save();
            }
        }
//        $post->title = $request->input('title');
//        $post->body = $request->input('body');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
//        $post->fill($request->validated());
//        $post->save();
        $post->update($request->validated());
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
