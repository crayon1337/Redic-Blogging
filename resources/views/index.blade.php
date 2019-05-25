@extends('layouts.app')

@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                    <img width="100%" height="225" src="{{ $post->imgUrl }}">
                    <div class="card-body">
                        <p class="card-text">{{ $post->title }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.show', ['id' => $post->id ]) }}">View</a>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.edit', ['id' => $post->id ]) }}">Edit</a>
                        </div>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
