@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <p class="lead text-center font-weight-bold m-0">Search Movies</p>
                    <p class="small text-muted text-center">Search for a movie to request it.</p>
                    <form id="searchform" action="/search/movies" method="POST">
                        @csrf
                        <div class="form-group text-center col-md-6 mx-auto">
                            <input type="text" class="form-control text-center" id="searchbox" name="movie" placeholder="Search by Movie Title...">
                            <p class="small text-muted text-center mt-2" id="search-help" style="display: none"></p>
                        </div>
                    </form>

                    <div id="search-alert" style="display: none"></div>

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
    $('#searchbox').on('focus', function(){
        $('#search-help').html('Press <kbd>enter</kbd> or <kbd>return</kbd> to search!').slideDown();
    })

    $( '#searchform' ).on( 'submit', function ( e ) {
        e.preventDefault();
        search.reset()
        search.search( $( '#searchbox' ).val(), $('meta[name="csrf-token"]').attr('content') )
        $( '#searchbox' ).blur()
    } )

    $( '#movie-list' ).on( 'click', '.movie-item', '.movie-item', function ( e ) {
        var data = e.currentTarget.dataset;
        var $modal = $( '#movie-modal' )
        movie.start( $modal, data )
    } )

</script>
@endpush