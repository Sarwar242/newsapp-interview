@extends('public.layout.master')
@section('title', 'Welcome to NewsApp')
@section('content')
         <div class="album py-5 bg-light">
        <div class="container">
          @if($articles?->count()>0)
            <h2> Latest News:</h2> <br>
          @endif
          <div class="row">
                  @foreach($articles as $article)
                    <div class="col-md-4">
                      <div class="card mb-4 box-shadow bg-light border-0">
                        <img class="card-img-top" src="{{url($article->thumb)}}" width="250" height="250" alt="Image" style="z-index: 1; border-radius: 1.25rem 1.25rem 0 0;"/>
                          <div class="card-body"  style="z-index: 1;">
                            <a href="{{URL::to('article/'.$article->id )}}"><h4 class="card-text">{{Str::words($article->title, $words = 6, $end='...');}}</h4></a>
                         </div>
                       </div>
                     </div>
                  @endforeach
                </div>
            </div>

      </div>
      <div class="container">

        <div class="pos" style="margin-left:500px">
    {{ $articles->links() }}
</div>
</div>

@endsection
