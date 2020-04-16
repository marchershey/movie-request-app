var functions = {

    reset: () => {
        $( '#movie-list' ).empty()
        $( '#search-loading' ).fadeIn()
        $( '#movie-list' ).slideUp()
    },

    tmdb: ( movie ) => {
        $.ajax( {
            type: "POST",
            url: './search/tmdb',
            data: {
                'movie': movie,
                '_token': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            },
            success: function ( data ) {
                console.log( data )
                var html = ''
                $.each( data.results, function ( key, movie ) {
                    var poster = ( movie.poster_path == null ) ? 'https://i.imgur.com/yNRAnse.png' : 'https://image.tmdb.org/t/p/w300/' + movie.poster_path
                    html += `
                    <div class="movie-item col-6 col-md-3 mb-3" data-tmdbid="${ movie.id }" data-title="${ movie.title }" data-year="${ movie.release_date.substr( 0, 4 ) }" data-overview="${ movie.overview }" data-poster="${ poster }">
                        <div class="card">
                            <img src="${poster }" class="card-img-top img-fluid" alt="movie poster">
                                <div class="card-body font-weight-bold text-truncate text-center p-2">
                                    ${movie.title }
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                } )
                $( '#movie-list' ).append( html ).imagesLoaded().then( function () {
                    $( '#search-loading' ).slideUp()
                    $( '#movie-list' ).slideDown()
                } )
            }
        } )

    }

}

module.exports = functions
