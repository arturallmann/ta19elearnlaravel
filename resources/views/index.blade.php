@extends('layout')
@section('title', 'Home Page')
@section('content')
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
    </div>
    {{$posts->links()}}
@endsection
