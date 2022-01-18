<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class HomeController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(16);
        return view('index', compact('posts'));
    }

    public function post(Post $post) {
        return view('post', compact('post'));
    }
    public function tag(Tag $tag){
        $posts = $tag->posts()->latest()->paginate(16);
        return view('index', compact('posts'));
    }
    public function user(User $user){
        $posts = $user->posts()->paginate();
        return response()->view('index', compact('posts', 'user'));
    }
}
