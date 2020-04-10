@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <h1 class="text-center font-weight-bold">Queue List</h1>
            <p class="text-center text-muted">Movies which are in queue to be added.</p>
            <div class="alert alert-info text-center" role="alert">
                <strong>Note:</strong> The list below is ordered by <strong>votes</strong>. The movies with the most votes get added first. Tap/click on a movie to vote on it.
            </div>
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
                <div class="card-body pb-0">
                    <div id="movie-list" class="row">
                        @if(count($queues) > 0)
                        @foreach($queues as $q)
                        <div class="movie-item col-4 col-lg-2 mb-3" data-id="{{$q->movies->id}}" data-tmdb-id="{{$q->movies->tmdb_id}}" data-title="{{$q->movies->title}}" data-desc="{{$q->movies->desc}}" data-year="{{$q->movies->year}}" data-poster="{{$q->movies->poster}}" data-trailer="{{$q->movies->trailer}}" data-votes="{{$q->votes}}" data-queue-id="{{$q->id}}">
                            <img src="{{$q->movies->poster}}" alt="" class="img-thumbnail img-fluid">
                        </div>
                        @endforeach
                        @else
                        <div class="col">
                            <p class="text-center font-weight-bold">
                                No movies in the queue.
                            </p>
                            <p class="text-center">
                                You can request a movie by <a href="{{route('index.search')}}">searching</a> or checking out the <a href="{{route('index.trending')}}">trending</a> page.
                            </p>
                        </div> @endif </div>
                    <div class="d-flex justify-content-center">
                        {{$queues->links()}}
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
        var votes = $movie.data( 'votes' )
        var queue_id = $movie.data( 'queue-id' )
        movie.openMovieModal( id, tmdb, title, year, desc, poster, trailer, 'vote', votes, queue_id )
    } )

</script>
@endpush
