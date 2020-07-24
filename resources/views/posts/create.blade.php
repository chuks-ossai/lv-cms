@extends('layouts.app');

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? 'Update Post' : 'Create Post'}}
    </div>
    <div class="card-body">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @endif
        <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
            @method('PUT')
            @endif
            <div class="form-group mb-3">
                <label for="name">Title</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ $post->title ?? ''}}">
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" type="text" rows="4" id="description" name="description">{{ $post->description ?? ''}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="content">Content</label>
                <!-- <textarea class="form-control" type="text" rows="8" id="content" name="content">{{ $post->content ?? ''}}</textarea> -->

                <input id="content" type="hidden" name="content" value="{{ $post->content ?? ''}}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group mb-3">
                <label for="content">Publication Date</label>
                <input class="form-control" type="text" id="published_at" name="published_at" value="{{ $post->published_at ?? ''}}">
            </div>
            @if(isset($post) && $post->img_url)
            <div class="form-group mb-2">
                <img src="{{ asset('storage/' . $post->img_url) }}" alt="{{$post->title}}" class="img-fluid">
            </div>
            @endif
            <div class="form-group mb-3">
                <label for="img_url">Image</label>
                <input class="form-control" type="file" id="img_url" name="img_url">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-success btn-sm">{{isset($post) ? 'Submit Update' : 'Submit' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>
<script>
    flatpickr("#published_at", {
        enableTime: true
    });
</script>
@endsection
