@extends('layouts.app')

@section('content')
<div class="container" id="request">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <h1 class="text-center font-weight-bold">Trending Movies</h1>
            <p class="text-center text-muted">View the top trending movies in the US.</p>
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
        <div class="col-12">

            <div class="error alert alert-danger text-center" role="alert" style="display:none;">
                <strong>Error:</strong> <span class="error-text"></span>
            </div>

            <ul class="nav nav-pills justify-content-center mb-3" id="trending-select" role="tablist">
                <li class="nav-item">
                    <a class="daily nav-link active" id="daily-tab" data-toggle="pill" href="#tabs-daily" role="tab" aria-controls="tabs-daily" aria-selected="true">
                        Daily Trending
                    </a>
                </li>
                <li class="nav-item">
                    <a class="weekly nav-link" id="weekly-tab" data-toggle="pill" href="#tabs-weekly" role="tab" aria-controls="tabs-weekly" aria-selected="false">
                        Weekly Trending
                    </a>
                </li>
            </ul>

            <div class="loading row">
                <div class="col text-center">
                    <img src="./images/loading.gif" alt="loading_gif" class="img-fluid">
                </div>
            </div>

            <div class="tab-content" id="trending-tabs">
                <div class="tab-pane fade show active" id="tabs-daily" role="tabpanel" aria-labelledby="tabs-daily-tab">
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-12 col-lg-8">
                            <div class="movie-list row" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-weekly" role="tabpanel" aria-labelledby="tabs-weekly-tab">
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-12 col-lg-8">
                            <div class="movie-list row" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>
@endsection

@include('inc.modals.movie')

@push('scripts')
<script>
    trending.loadDaily()

    $( '.daily' ).on( 'click', function () {
        trending.loadDaily()
    } )

    $( '.weekly' ).on( 'click', function () {
        trending.loadWeekly()
    } )

    $( '.movie-list' ).on( 'click', '.movie-item', '.movie-item', function ( e ) {
        var data = e.currentTarget.dataset;
        movie.openMovieModal( data.id, data.tmdbId, data.title, data.year, data.desc, data.poster, null, 'request' )
    } )

</script>
@endpush
