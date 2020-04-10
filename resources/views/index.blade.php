@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <h1 class="text-center font-weight-bold">{{config('app.name')}}</h1>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="h3 font-weight-bold">News:</h1>
                    <div class="col post">
                        No news.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="h3 font-weight-bold">Movies <small class="text-muted">Movies I have installed</small></h1>
                    <div id="movie-list" class="row">
                        @if(count($movies) > 0)
                        @foreach($movies as $movie)
                        <div class="movie-item col-4 col-lg-2 mb-3" data-id="{{$movie->id}}" data-tmdb-id="{{$movie->tmdb_id}}" data-title="{{$movie->title}}" data-desc="{{$movie->desc}}" data-year="{{$movie->year}}" data-poster="{{$movie->poster}}" data-trailer="{{$movie->trailer}}">
                            <img src="{{$movie->poster}}" alt="" class="img-thumbnail img-fluid">
                        </div>
                        @endforeach
                        @else
                        <div class="col mb-3">
                            No movies installed.
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$movies->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.modals.movie')
@endsection

@push('scripts')
<script>
    $( '.movie-item' ).on( 'click', function () {
        var $movie = $( this )
        var id = $movie.data( 'id' )
        var tmdb = $movie.data( 'tmdb-id' )
        var title = $movie.data( 'title' )
        var year = $movie.data( 'year' )
        var desc = $movie.data( 'desc' )
        var poster = $movie.data( 'poster' )
        var trailer = $movie.data( 'trailer' )
        movie.openMovieModal( id, tmdb, title, year, desc, poster, trailer )
    } )

</script>
@endpush
