@extends('layout')
@section('title', $post->title)
@section('content')
    <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
    <div class="card mt-3">
        @if($post->images->count() > 1)
            @include('partials.carousel', ['images' => $post->images, 'id' => $post->id])
        @elseif($post->images->count() == 1)
            <img src="{{$post->images->first()->path}}" class="card-img-top" alt="...">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{!! $post->displayBody !!}</p>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <form action="{{route('comments.store', ['post' => $post->id])}}" method="POST">
                @csrf
                <textarea class="form-control" name="body" cols="6"></textarea>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    @foreach($post->comments()->latest()->get() as $comment)
        <div class="card my-2">
            <div class="card-body">
                <p class="card-text">{{$comment->body}}</p>
                <p class="text-muted">{{$comment->user->name}}</p>
                <p class="text-muted">{{$comment->created_at->diffForHumans()}}</p>

            </div>
        </div>
    @endforeach
@endsection
