@extends('layout')

@section('content')

    <div class="card-body">
        <h2>{{$user->name}}</h2>
        <h3>Posts: {{$user->posts->count()}}</h3>
        <h3>User post comments: {{$user->postComments->count()}}</h3>
    </div>
    {{$posts->links()}}
        @foreach($posts as $post)
            <div class="col">
                <div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p class="card-text">{{$post->snippet}}</p>
        <a href="{{route('user', ['user' => $post->user])}}">{{$post->user->name}}</a>
        <p class="text-muted">{{$post->created_at->diffForHumans()}}</p>
        <p>
            @foreach($post->tags as $tag)
                <a href="{{route('tag', ['tag' => $tag])}}">{{$tag->name}}</a>
            @endforeach
        </p>
        <p class="text-muted">Comments: {{$post->comments()->count()}}</p>

        <a href="/post/{{$post->id}}" class="btn btn-primary">Read more!</a>
    </div>
                </div>
            </div>
    @endforeach
    {{$posts->links()}}
@endsection
