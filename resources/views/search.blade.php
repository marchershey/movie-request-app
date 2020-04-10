@extends('layouts.app')

@section('content')
<div class="container" id="request">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <h1 class="text-center font-weight-bold">Search</h1>
            <p class="text-center text-muted">Search for a movie and add it to queue.</p>
            <div class="error alert alert-danger text-center" role="alert" style="display:none;">
                <strong>Error:</strong> <span class="error-text"></span>
            </div>
            @if (session('status'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-5">
            <form class="movie-search-form" autocomplete="off">
                <div class="form-group text-center">
                    <input type="text" class="searchbox form-control text-center" placeholder="Search..." autocomplete="off">
                    <p class="searchboxtext small text-muted mt-1">Start typing the movie name above...</p>
                    <div class="searchwarning alert alert-warning text-center" role="alert">
                        <strong>Note:</strong> The API is very strict. Meaning, you need to make sure you type the correct movie title to get the correct result. Any spelling errors will affect the results.<br>
                        <br>
                        <strong>Example:</strong> "the blind sdie" will not return the movie "The Blind Side"
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-8">
            <div class="loading row" style="display:none;">
                <div class="col text-center">
                    <img src="./images/loading.gif" alt="loading_gif" class="img-fluid">
                </div>
            </div>
            <div class="movie-list row" style="display:none;">
            </div>
        </div>
    </div>


</div>
@endsection

@include('inc.modals.movie')

@push('scripts')
<script>
    $( '.movie-list' ).on( 'click', '.movie-item', '.movie-item', function ( e ) {
        var data = e.currentTarget.dataset;
        movie.openMovieModal( data.id, data.tmdbId, data.title, data.year, data.desc, data.poster, null, 'request' )
    } )

    $( '.searchbox' ).focusin( function () {
        $( '.searchboxtext' ).html( 'Press <kbd>return</kbd> or <kbd>enter</kbd> when you\'re done.' )
        $( '.searchwarning' ).slideUp()
    } ).focusout( function () {
        if ( !$( this ).val() ) {
            $( '.searchboxtext' ).text( 'Start typing the movie name above...' )
        }
    } )

    $( '.movie-search-form' ).on( 'submit', function ( e ) {
        e.preventDefault();
        $searchbox = $( '.searchbox' )
        $searchbox.blur()
        var query = $searchbox.val()
        if ( query ) {
            search.run( query )
        } else {
            search.failed( 'You need to enter a search query. ' )
        }
    } )

</script>
@endpush
