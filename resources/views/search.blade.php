@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <p class="lead text-center m-0">Request a Movie</p>
                    <p class="small text-muted text-center">Search for a movie to request it.</p>
                    <form id="searchform" action="/search/tmdb" method="POST">
                        @csrf
                        <div class="form-group text-center">
                            <input type="text" class="form-control text-center" id="searchbox" placeholder="Search...">
                            <p class="small text-muted text-center mt-2">Submit to search!</p>
                        </div>
                    </form>

                    <div id="search-loading" class="col-12 text-center" style="display: none;">
                        <img src="https://i.imgur.com/Lf8J3EH.gif" alt="loading">
                    </div>

                    <div class="row justify-content-center" id="movie-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.movie')

@endsection


@push('scripts')
<script>
    $( '#searchform' ).on( 'submit', function ( e ) {
        e.preventDefault();
        search.reset()
        search.search( $( '#searchbox' ).val() )
        $( '#searchbox' ).blur()
    } )

    $( '#movie-list' ).on( 'click', '.movie-item', '.movie-item', function ( e ) {
        var data = e.currentTarget.dataset;
        var $modal = $( '#movie-modal' )
        movie.start( $modal, data )
    } )

</script>
@endpush
