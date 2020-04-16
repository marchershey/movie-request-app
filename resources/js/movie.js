$( '#movie-modal' ).on( 'hide.bs.modal', function () {
    movie.resetModal( $( this ) )
} )

var functions = {

    start: ( $modal, data ) => {
        movie.resetModal( $modal )
        movie.loadModal( $modal, data )
        movie.loadTrailers( $modal, data.tmdbid, data.title )
        movie.showModal( $modal )
    },

    showModal: ( $modal ) => {
        $modal.modal( 'show' )
        $modal.on( 'shown.bs.modal', function ( e ) {
            $modal.find( '#movie' ).slideDown()
            $modal.find( '#movie-loading' ).slideUp()

        } )
    },

    resetModal: ( $modal ) => {
        $modal.find( '#movie' ).fadeOut( function () {
            $modal.find( '.movie-trailer' ).empty()
        } )
    },

    loadModal: ( $modal, data ) => {
        $modal.find( '#movie-loading' ).show()
        $modal.find( '.movie-tmdb-id' ).text( data.tmdbid )
        $modal.find( '.movie-title' ).text( data.title )
        $modal.find( '.movie-year' ).text( data.year )
        $modal.find( '.movie-desc' ).html( data.overview )
        $modal.find( '.movie-poster' ).attr( 'src', data.poster )
    },

    loadTrailers: ( $modal, tmdbid, title ) => {
        // ^(https|http):\/\/(?:www\.)?youtube.com\/embed\/[A-z0-9]+
        $.ajax( {
            type: "POST",
            url: './search/tmdb/videos',
            data: {
                'tmdbid': tmdbid,
                '_token': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            }
        } ).done( function ( data ) {
            console.log( data )
            var html = ''
            if ( data.results.length == 0 ) {
                html = '<div class="text-center">Failed to load trailers... Try to <a href="https://www.youtube.com/results?search_query=' + title + '+trailer" target="_blank">search YouTube</a>.</div>'
                $modal.find( '.movie-trailer' ).html( html )
            } else {
                $.each( data.results, function ( key, trailer ) {
                    html = '<div class="youtube-video"><iframe width="560" height="315" src="https://youtube.com/embed/' + trailer.key + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
                    $modal.find( '.movie-trailer' ).html( html )
                    return key < 0
                } )
            }
        } )
    },

    request: ( tmdbid ) => {

    }

}

module.exports = functions
