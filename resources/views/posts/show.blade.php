@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-9">
        <div class="card">
            <img class="card-img-top" src="{{ $post->imgUrl }}" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! $post->body !!}</p>

                <hr />

                <h4>Comments</h4>
                @foreach($comments as $comment)
                <div class="card">
                    <div class="card-header">{{ $comment->email }}</div>
                    <div class="card-body">{{ $comment->comment }}</div>
                </div>
                @endforeach
                <div class="card mt-2">
                    <div class="card-header">Add Comment</div>
                    <div class="card-body">
                        <form action="{{ route('addComment', ['postId' => $post->id]) }}" method="POST">
                            @csrf
                            <label>EMail: </label>
                            <input type="text" class="form-control" name="email">
                            <label>Comment: </label>
                            <textarea name="comment" class="form-control"></textarea>
                            <input type="submit" value="Submit" class="btn btn-success btn-lg float-right mt-2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-4">
                        <span>Category: <strong>{{ $post->getCategory->name }}</strong></span>
                    </div>
                    <div class="col-4">
                        <span>Created <strong>{{ $post->created_at->diffForHumans() }}</strong></span>
                    </div>
                    <div class="col-4">
                    @can('update', App\Post::class)
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.edit', ['id' => $post->id ]) }}">Edit</a>
                    @endcan
                    @can('delete', App\Post::class)
                        <a class="btn btn-sm btn-danger" href="{{ route('posts.destroy', ['id' => $post->id ]) }}"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">
                            {{ __('Delete') }}
                        </a>
                        <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', ['id' => $post->id ]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        @if(count($relatedPosts) > 0)
            <h4>Related Articles</h4>
            <hr />
            @foreach($relatedPosts as $post)
                <div class="card">
                    <a href="{{ route('posts.show', ['id' => $post->id ]) }}"><img class="card-img-top" src="{{ $post->imgUrl }}" alt="{{ $post->title }}"></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->body !!}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection