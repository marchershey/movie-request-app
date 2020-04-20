var functions = {

    start: ( $modal, data ) => {
        movie.resetModal( $modal )
        $.when( movie.loadModal( $modal, data ) ).done( function () {
            movie.showModal( $modal )
        } )
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
        $modal.find( '#movie-modal-alert-text' ).html( '' )
        $modal.find( '#movie-modal-badge-text' ).html( '' )
        $modal.find( '#actions' ).html( '' )
    },

    loadModal: ( $modal, data ) => {
        $modal.find( '#movie-loading' ).show()
        $modal.find( '.movie-tmdb-id' ).text( data.tmdbid )
        $modal.find( '.movie-poster' ).attr( 'src', data.poster )
        $modal.find( '.movie-title' ).text( data.title )
        $modal.find( '.movie-year' ).text( data.year )
        $modal.find( '.movie-desc' ).html( data.overview )

        movie.loadBadges( $modal, data )
        movie.loadAlerts( $modal, data )
        movie.loadActions( $modal, data )
        movie.loadTrailers( $modal, data.trailer, data.title )

        movie.showModal( $modal )
    },

    loadBadges: ( $modal, data ) => {
        if ( data.status == 'announced' ) {
            movie.badge( $modal, 'Not released yet', 'danger' )
        }

        if ( data.monitored == 'true' ) {
            if ( data.downloaded == 'true' ) {
                movie.badge( $modal, 'Installed', 'success' )
            } else {
                movie.badge( $modal, 'Processing', 'warning' )
            }
            movie.badge( $modal, 'Monitored' )
        }
    },

    loadAlerts: ( $modal, data ) => {
        if ( data.status == 'announced' ) {
            if ( data.monitored == 'false' ) {
                movie.alert( $modal, 'This movie has yet to be released, which means you may still request it, but chances are it will not be downloaded until it\'s released.', 'warning' )

            }
        }
    },

    loadActions: ( $modal, data ) => {
        $action = $modal.find( '#actions' )

        if ( data.monitored == 'false' ) {
            var html = `<button type="button" id="movie-request-button" class="btn btn-primary btn-lg btn-block">Request ${ data.title }</button>`
            $action.html( html )
            $action.slideDown()
        }
    },

    loadTrailers: ( $modal, trailer, title ) => {
        var html = ''
        if ( !trailer ) {
            html = '<div class="text-center">Could not find any trailers... Try to <a href="https://www.youtube.com/results?search_query=' + title + '+trailer" target="_blank">search YouTube</a>.</div>'
            $modal.find( '.movie-trailer' ).html( html )
        } else {
            html = '<div class="youtube-video"><iframe width="560" height="315" src="https://youtube.com/embed/' + trailer + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
            $modal.find( '.movie-trailer' ).html( html )
        }
    },

    alert: ( $modal, text, type = 'primary' ) => {
        $alert = $modal.find( '#movie-modal-alert' )
        $alertText = $modal.find( '#movie-modal-alert-text' )

        $alert.show()

        var html = `<div class="alert alert-${ type } text-center" role="alert" style="display:none;">
                        ${ text }
                    </div>`

        $( html ).append( $alertText ).slideDown()
    },

    badge: ( $modal, text, type = 'primary' ) => {
        $alert = $modal.find( '#movie-modal-badge' )
        $alertText = $modal.find( '#movie-modal-badge-text' )

        $alert.show()

        var html = `<span class="badge badge-${ type } mr-1">${ text }</span>`

        $alertText.prepend( html )
    },

    request: ( $modal, tmdbid ) => {
        // movie.requestLoading( $modal )
        $badges = $modal.find( '#movie-modal-badge-text' )
        $button = $modal.find( '#movie-request-button' )
        $button.html( '<i class="fas fa-spinner fa-pulse" style="font-size:27px"></i>' ).prop( 'disabled', true )
        $.ajax( {
            type: "POST",
            url: './movie/request',
            data: {
                'tmdbid': tmdbid,
                '_token': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            }
        } ).done( function ( data ) {
            if ( data.status == 'failed' ) {
                movie.alert( $modal, data.message + ' Refresh the page and try again.', 'danger' )
                $button.slideUp()
            } else if ( data.status == 'success' ) {
                movie.badge( $modal, 'Processing', 'warning' )
                movie.badge( $modal, 'Monitored' )
                $button.slideUp()
                movie.alert( $modal, 'This movie was successfully requested!', 'success' )
            } else {
                //
            }
        } ).fail( function ( response ) {
            // need to set up error response on this one
            console.log( response.responseJSON.message )
            movie.alert( $modal, '<strong>Server Error:</strong> ' + response.responseJSON.message, 'danger' )
            $button.slideUp()
        } )
    }

}

module.exports = functions
