@extends('layout')
@section('title', 'Home Page')
@section('content')
    @isset($user)
        <div class="card">
            <div class="card-body">
                <h1>{{$user->name}}</h1>
                <p><b>Posts:</b>{{$user->posts()->count()}}</p>
                <p><b>Comments:</b>{{$user->comments()->count()}}</p>
                <p><b>Comments on Posts:</b>{{$user->commentsOnPosts()->count()}}</p>
            </div>
        </div>
    @endif
    {{$posts->links()}}
    <div class="row row-cols-4">
        @foreach($posts as $post)
            <div class="col">
                <div class="card mt-3">
                    @if($post->images->count() > 1)
                        @include('partials.carousel', ['images' => $post->images, 'id' => $post->id])
                    @elseif($post->images->count() == 1)
                        <img src="{{$post->images->first()->path}}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->snippet}}</p>
                        <p class="text-muted"><a href="{{route('user', ['user' => $post->user])}}" class="card-link">{{ $post->user->name }}</a></p>
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
    </div>
    {{$posts->links()}}
@endsection
