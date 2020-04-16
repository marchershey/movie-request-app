<div class="modal fade" id="movie-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modal-title">
                    <span class="movie-title">Movie Name</span> <span class="small text-muted">ID: <span class="movie-tmdb-id">####</span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.8rem">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="movie-loading" style="display: none;">
                    <div class="row">
                        <div class="col text-center">
                            <img src="https://i.imgur.com/Lf8J3EH.gif" alt="loading..." class="img-fluid">
                        </div>
                    </div>
                </div>

                <div id="movie" style="display: none;">
                    <div class="row">
                        <div class="col-6 col-lg-4 text-center mb-3 mx-auto">
                            <img src="https://via.placeholder.com/199x299?text=Movie+Poster" alt="" class="movie-poster img-thumbnail img-fluid">
                        </div>
                        <div class="col-lg-8">
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

                            <div class="row">
                                <div class="col mb-3">
                                    <button type="button" id="movie-request-button" class="btn btn-primary btn-lg btn-block">Request <span class="movie-title"></span></button>
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
</div>

@push('scripts')
<script>
    $( '#movie-request-button' ).on( 'click', function () {
        movie.request( $( '.movie-tmdb-id' ).text() )
    } )

</script>
@endpush
