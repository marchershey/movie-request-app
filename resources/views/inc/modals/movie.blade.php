<div class="modal fade" id="movie-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modal-title">
                    <span class="movie-title">Movie Name</span> <span class="small text-muted"><span class="movie-id">12</span>-<span class="movie-tmdb-id">123456</span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.8rem">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="loading row" style="display: none;">
                    <div class="col text-center">
                        <img src="./images/loading.gif" alt="loading_gif" class="img-fluid">
                    </div>
                </div>

                <div class="movie-container row" style="display:none;">
                    <div class="col-6 col-lg-4 text-center mb-3 mx-auto">
                        <img src="https://via.placeholder.com/199x299?text=Movie+Poster" alt="" class="movie-poster img-thumbnail img-fluid">
                        <p class="movie-votes mt-2">Total Votes: <span class="movie-votes-count"></span></p>
                    </div>
                    <div class="movie-data-container col-lg-8">
                        <div class="row">
                            <div class="col">
                                <h1 class="h3 font-weight-bold text-center text-lg-left">
                                    <span class="movie-title">Movie Title</span>
                                    <span class="movie-year small text-muted">2009</span>
                                </h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <span class="movie-desc text-muted">This is the movie description.</span>
                            </div>
                        </div>

                        <div class="movie-modal-error row" style="display: none">
                            <div class="col">
                                <div class="alert alert-danger text-center" role="alert">
                                    <strong>Error:</strong> <span class="movie-modal-error-text"></span>
                                </div>
                            </div>
                        </div>

                        <div class="movie-modal-success row" style="display: none">
                            <div class="col">
                                <div class="alert alert-success text-center" role="alert">
                                    <span class="movie-modal-success-text"></span>
                                </div>
                            </div>
                        </div>

                        <div class="movie-modal-info row" style="display: none">
                            <div class="col">
                                <div class="alert alert-info text-center" role="alert">
                                    <span class="movie-modal-info-text"></span>
                                </div>
                            </div>
                        </div>

                        <div class="movie-actions row">
                            <div class="col mb-3">
                                <div class="movie-action-request" style="display: none;">
                                    @if(Auth::check())
                                    <form class="movie-request-form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" class="movie-id">
                                        <input type="hidden" name="tmdb_id" class="movie-tmdb-id">
                                        <input type="hidden" name="title" class="movie-title">
                                        <input type="hidden" name="year" class="movie-year">
                                        <input type="hidden" name="desc" class="movie-desc">
                                        <input type="hidden" name="poster" class="movie-poster">
                                        <input type="hidden" name="trailer" class="movie-trailer">
                                        <button type="submit" class="movie-request-button btn btn-primary btn-block">Request Movie</button>
                                    </form>
                                    @else
                                    <div class="alert alert-primary text-center" role="alert">
                                        <a href="{{route('login')}}">Sign in</a> or <a href="{{route('register')}}">Create an account</a> to <strong>request</strong> this movie.
                                    </div>
                                    @endif
                                </div>
                                <div class="movie-action-vote" style="display: none;">
                                    @if(Auth::check())
                                    <form class="movie-vote-form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="movie_id" class="movie-id">
                                        <input type="hidden" name="queue_id" class="queue-id">
                                        <button type="submit" class="movie-request-button btn btn-primary btn-block">Vote for this movie!</button>
                                    </form>
                                    @else
                                    <div class="alert alert-primary text-center" role="alert">
                                        <a href="{{route('login')}}">Sign in</a> or <a href="{{route('register')}}">Create an account</a> to <strong>vote</strong> for this movie.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <h1 class="h5 font-weight-bold">Trailer</h1>
                                <hr>
                                <div class="movie-trailer"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $( '.movie-request-form' ).on( 'submit', function ( e ) {
        e.preventDefault()
        movie.request( $( this ) )
    } )
    $( '.movie-vote-form' ).on( 'submit', function ( e ) {
        e.preventDefault()
        movie.vote( $( this ) )
    } )

</script>
@endpush
