@extends('public.layout.master')
@section('title', 'Articles By Category')
@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar with categories -->
                <div class="sidebar">
                    <h5 class="p-2">Categories</h5>
                    <ul class="list-group" style="max-height: 400px; overflow-y: auto;">
                        @foreach($categories as $category)
                            <li class="list-group-item @if($activeCategory->id == $category->id) active @endif">
                                <a href="{{ route('public.category', ['category' => $category->id]) }}" class="text-dark">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Articles -->
                <h2 class="text-center">Current Category: <strong>{{$activeCategory->name}}</strong> </h2>
                <br>
                <div class="row">
                    @foreach($activeCategory->articles as $article)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow bg-light border-0">
                                <img class="card-img-top" src="{{ url($article->thumb) }}" width="250" height="200" alt="Image" style="z-index: 1; border-radius: 1.25rem 1.25rem 0 0;" />
                                <div class="card-body" style="z-index: 1;">
                                    <a href="{{ URL::to('article/'.$article->id ) }}">
                                        <h4 class="card-text">{{ Str::words($article->title, $words = 6, $end='...') }}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
