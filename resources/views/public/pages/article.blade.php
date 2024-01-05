@extends('public.layout.master')
@section('title', 'News Details')
@section('content')
<div class="container">
    <img src="{{$article->getImage()}}" style="max-width: 99%; margin:30px 0;"/>
    <h2>{{$article->title}}.</h2>
    <br>
    <h4>By {{$article?->author?->full_name}}</h4>
    <br>
    <p>{!! $article->article !!}</p>

    <div class="mt-5">
    <h2>Comments</h2>
    <hr>

    <!-- Comment Form -->
    @auth
    <div class="mb-3">
        <form id="commentForm" action="{{route('public.comment')}}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>
    @endauth
    <!-- Comment List -->
    <div id="commentList">
        @foreach($article->comments as $comment)
        <div class="card mb-2 border-1">
            <div class="card-body">
                <h5 class="card-title">{{$comment?->user?->full_name}}</h5>
                <p class="card-text">{{$comment?->comment}}</p>
                @if(auth()->id()==$comment?->user_id)
                    <button type="button" class="btn btn-danger btn-sm  delete-comment" onclick="confirmFormModal('{{route('public.comment.delete', $comment?->id)}}', 'Confirmation', 'Are you sure to delete operation?')">Delete</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

</div>
@endsection
