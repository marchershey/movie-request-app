@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3">

        <div class="col-12 col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="h3 font-weight-bold">News:</h1>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-1">No news.</li>
                    </ul>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="h3 font-weight-bold">Recent:</h1>

                    <ul class="list-group list-group-flush">
                        @if(count($events) > 0)
                        @foreach($events as $event)

                        @php
                        $user = (!$event->anonymous) ? $event->user->name : 'Anonymous';
                        @endphp

                        <li class="list-group-item p-1"><strong class="text-capitalize">{{$user}}</strong> added <strong>{{$event->title}}</strong> <span class="event-time">{{$event->created_at->getTimestamp()}}</span></li>

                        @endforeach
                        @else
                        <li class="list-group-item p-1">No events.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="h3 font-weight-bold">Movies <small class="text-muted">- {{$count}} Available Movies</small></h1>
                    <div id="movie-list" class="row">
                        @if(count($movies) > 0)
                        @foreach($movies as $movie)
                        <div class="movie-item col-4 col-lg-2 mb-3" data-id="{{$movie['id']}}" data-tmdb-id="{{$movie['tmdbId']}}" data-title="{{$movie['title']}}" data-desc="{{$movie['overview']}}" data-year="{{$movie['year']}}" data-poster="{{ env('RADARR_SERVER') . ':' . env('RADARR_PORT') . '/MediaCover/' . $movie['id'] . '/poster.jpg'}}" data-trailer="">
                            <img src="{{ env('RADARR_SERVER') . ':' . env('RADARR_PORT') . '/MediaCover/' . $movie['id'] . '/poster.jpg'}}" alt="" class="img-thumbnail img-fluid">
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

{{-- <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="h3 font-weight-bold">Movies ({{$count}}) <small class="text-muted">Available movies</small></h1>
<div id="movie-list" class="row">
    @if(count($movies) > 0)
    @foreach($movies as $movie)
    <div class="movie-item col-6 col-lg-2 mb-3" data-id="{{$movie['id']}}" data-tmdb-id="{{$movie['tmdbId']}}" data-title="{{$movie['title']}}" data-desc="{{$movie['overview']}}" data-year="{{$movie['year']}}" data-poster="{{ env('RADARR_SERVER') . ':' . env('RADARR_PORT') . '/MediaCover/' . $movie['id'] . '/poster.jpg'}}" data-trailer="">
        <img src="{{ env('RADARR_SERVER') . ':' . env('RADARR_PORT') . '/MediaCover/' . $movie['id'] . '/poster.jpg'}}" alt="" class="img-thumbnail img-fluid">
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
</div> --}}
</div>
@include('inc.modals.movie')
@endsection

@push('scripts')
<script>
    $('.event-time').text(function(index, value) {
        return moment(value, 'X').fromNow();
    })

    $( '.movie-item' ).on( 'click', function () {
        var $movie = $( this )
        var id = $movie.data( 'id' )
        var tmdb = $movie.data( 'tmdb-id' )
        var title = $movie.data( 'title' )
        var year = $movie.data( 'year' )
        var desc = $movie.data( 'desc' )
        var poster = $movie.data( 'poster' )
        var trailer = $movie.data( 'trailer' )
        movie.openMovieModal( id, tmdb, title, year, desc, poster, trailer, 'index' )
    } )

</script>
@endpush