var functions = {

    start: ( $modal, data ) => {
        movie.resetModal( $modal )
        movie.loadModal( $modal, data )
        movie.showModal( $modal )
    },

    loadModal: ( $modal, data ) => {
        $modal.find( '#movie-loading' ).show()
        $modal.find( '.movie-tmdb-id' ).text( data.tmdbid )
        $modal.find( '.movie-title' ).text( data.title )
        $modal.find( '.movie-year' ).text( data.year )
        $modal.find( '.movie-desc' ).html( data.overview )
        $modal.find( '.movie-poster' ).attr( 'src', data.poster )
    },

    showModal: ( $modal ) => {
        $modal.modal( 'show' )
        $modal.on( 'shown.bs.modal', function ( e ) {
            $modal.find( '#movie' ).slideDown()
            $modal.find( '#movie-loading' ).slideUp()

        } )
    },

    resetModal: ( $modal ) => {
        $modal.find( '#movie' ).hide()
    }

}

module.exports = functions
