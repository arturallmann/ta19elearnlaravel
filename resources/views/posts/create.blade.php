@extends('layout')
@section('title', 'Posts')
@section('content')
    <a href="{{url()->previous()}}" class="btn btn-primary mb-3">Back</a>
    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @error('title')
            @foreach($errors->get('title') as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{old('title')}}">
        </div>
        @error('body')
            @foreach($errors->get('body') as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @enderror
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea class="form-control" id="body" rows="3" name="body" required>{{old('body')}}</textarea>
        </div>

        @error('image[]')
            @foreach($errors->get('image[]') as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @enderror
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image[]" multiple accept="image/*">
        </div>

        <input class="btn btn-primary" type="submit">
    </form>
@endsection
