var $modal = $( '#movie-modal' )
var functions = {

    resetModal: () => {
        $modal.find( '.movie-votes' ).hide()
        $( '.movie-request-button' ).prop( 'disabled', false )
        $( '.movie-action-request' ).hide()
        $( '.movie-vote-button' ).prop( 'disabled', false )
        $( '.movie-action-vote' ).hide()
        movie.clearAlerts()
    },

    modalError: ( text ) => {
        $( '.movie-modal-error' ).slideDown()
        $( '.movie-modal-error-text' ).text( text )
    },

    modalSuccess: ( text ) => {
        $( '.movie-modal-success' ).slideDown()
        $( '.movie-modal-success-text' ).text( text )
    },

    modalInfo: ( text ) => {
        $( '.movie-modal-info' ).slideDown()
        $( '.movie-modal-info-text' ).text( text )
    },

    clearAlerts: () => {
        $( '.movie-modal-error' ).slideUp()
        $( '.movie-modal-success' ).slideUp()
        $( '.movie-modal-error-text' ).empty()
        $( '.movie-modal-success-text' ).empty()
        $( '.movie-modal-info' ).slideUp()
        $( '.movie-modal-info-text' ).empty()
    },

    buildList: ( data, trailer ) => {
        app.loadingStart( $( '.movie-list' ) )
        var output = ''
        $.each( data, function ( key, movie ) {
            year = ( movie.release_date == null || movie.release_date == 'undefined' ) ? '' : movie.release_date.slice( 0, 4 )
            desc = movie.overview.replace( /"/g, '' )
            poster = ( movie.poster_path == null ) ? 'https://i.imgur.com/yNRAnse.png' : 'https://image.tmdb.org/t/p/original' + movie.poster_path
            trailer = ( trailer == 'failed' ) ? '' : trailer
            output += '<div class="movie-item col-4 col-lg-3 mb-3 mx-auto" data-id="" data-tmdb-id="' + movie.id + '" data-title="' + movie.title + '" data-desc="' + desc + '" data-year="' + year + '" data-poster="' + poster + '"><img src="' + poster + '" alt="" class="img-thumbnail img-fluid"></div>'
        } )
        $( '.movie-list' ).append( output )
        app.loadingDone( $( '.movie-list' ) )
    },

    openMovieModal: ( movie_id, tmdbid, title, year, desc, poster, trailer_link, type = '', votes = '', queue_id = '', ) => {
        movie.resetModal()
        app.loadingStart( $modal.find( '.movie-container' ) )
        $modal.modal( 'show' )
        $modal.find( '.movie-id' ).text( movie_id ).attr( 'value', movie_id )
        $modal.find( '.queue-id' ).val( queue_id )
        $modal.find( '.movie-tmdb-id' ).text( tmdbid ).attr( 'value', tmdbid )
        $modal.find( '.movie-title' ).text( title ).attr( 'value', title )
        $modal.find( '.movie-year' ).text( year ).attr( 'value', year )
        $modal.find( '.movie-desc' ).html( desc ).attr( 'value', desc )
        $modal.find( '.movie-poster' ).attr( 'src', poster ).attr( 'value', poster )
        movie.loadVotes( movie_id, queue_id )
        movie.showButtons( type, tmdbid )
        movie.loadTrailers( tmdbid, title, trailer_link )
        app.loadingDone( $modal.find( '.movie-container' ) )
    },

    showButtons: ( type, tmdb_id ) => {
        if ( type == 'request' ) {
            $.ajax( {
                url: './movie/button/request',
                method: 'post',
                data: {
                    tmdb_id: tmdb_id,
                    _token: $( 'meta[name="csrf-token"]' ).attr( 'content' )
                },
                success: function ( results ) {
                    if ( results == 'added' ) {
                        movie.modalInfo( 'This movie has been added to the server.' )
                    } else if ( results == 'queue' ) {
                        movie.modalInfo( 'This movie is in the queue.' )
                    } else {
                        $modal.find( '.movie-action-request' ).show()
                    }
                }
            } )
        }

        if ( type == 'vote' ) {
            $.ajax( {
                url: './movie/button/vote',
                method: 'post',
                data: {
                    tmdb_id: tmdb_id,
                    _token: $( 'meta[name="csrf-token"]' ).attr( 'content' )
                },
                success: function ( results ) {
                    if ( results == 'voted' ) {
                        movie.modalInfo( 'You have already voted for this movie.' )
                    } else {
                        $modal.find( '.movie-action-vote' ).show()
                    }
                }
            } )
        }
    },

    loadVotes: ( movie_id, queue_id ) => {
        if ( queue_id != '' ) {
            $.ajax( {
                url: './movie/get/votes',
                method: 'post',
                data: {
                    movie_id: movie_id,
                    _token: $( 'meta[name="csrf-token"]' ).attr( 'content' )
                },
                success: function ( results ) {
                    $modal.find( '.movie-votes' ).show()
                    $modal.find( '.movie-votes-count' ).text( results )

                }
            } )
        }
    },

    updateVotes: () => {
        $modal.find( '.movie-votes-count' ).text( +$modal.find( '.movie-votes-count' ).text() + 1 )
    },

    loadTrailers: ( tmdbid, title, trailer_link ) => {
        // ^(https|http):\/\/(?:www\.)?youtube.com\/embed\/[A-z0-9]+
        var output = ''
        $.getJSON( 'https://api.themoviedb.org/3/movie/' + tmdbid + '/videos', { api_key: api.key } )
            .done( function ( trailer ) {
                $.each( trailer.results, function ( key, trailer ) {
                    output = '<div class="youtube-video"><iframe width="560" height="315" src="https://youtube.com/embed/' + trailer.key + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
                    $modal.find( '.movie-trailer' ).html( output ).val( trailer.key )
                    return key < 0
                } )
            } )
            .fail( function ( jqxhr, textStatus, error ) {
                output = '<div class="text-center">Failed to load trailers... Try to <a href="https://www.youtube.com/results?search_query=' + title + '+trailer" target="_blank">search YouTube</a>.</div>'
                $modal.find( '.movie-trailer' ).html( output ).val( 'failed' )
                // movie.buildList( data.results, 'failed' )
            } )
            .always( function ( trailer ) {
                //
            } )

        // $modal.find( '.movie-trailer' ).html( output )


        // var output
        // if ( link === '' || typeof link === 'undefined' || link === null ) {
        //     output = '<div class="text-center">No trailers available... Try to <a href="https://www.youtube.com/results?search_query=' + title + '+trailer" target="_blank">search YouTube</a>.</div>'
        // } else {
        //     output = '<div class="youtube-video"><iframe width="560" height="315" src="' + link + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
        // }


        // var output
        // if ( link != '' ) {
        //     output = '<div class="youtube-video"><iframe width="560" height="315" src="' + link + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
        // } else {
        //     output = '<div class="text-center">No trailers available... Try to <a href="https://www.youtube.com/results?search_query=' + title + '+trailer" target="_blank">search YouTube</a>.</div>'
        // }
    },

    request: ( form ) => {
        movie.clearAlerts()

        $( '.movie-request-button' ).prop( 'disabled', true )
        $( '.movie-action-request' ).slideUp()

        $.ajax( {
            url: './movie/action/request',
            method: 'post',
            data: form.serialize(),
            success: function ( results ) {
                if ( results == 'failed:save_movie' ) {
                    movie.modalError( 'Failed to save Movie to database.' )
                } else if ( results == 'failed:queue' ) {
                    movie.modalError( 'The movie was saved, but failed to add to queue.' )
                } else if ( results == 'failed:vote' ) {
                    movie.modalError( 'The movie was saved, and the movie was added to queue, but your vote was not saved.' )
                } else if ( results == 'success:queue' ) {
                    movie.modalSuccess( 'You successfully have added this movie to queue.' )
                }
            }
        } )
    },

    vote: ( form ) => {
        movie.clearAlerts()

        $( '.movie-vote-button' ).prop( 'disabled', true )
        $( '.movie-action-vote' ).slideUp()

        $.ajax( {
            url: './movie/action/vote',
            method: 'post',
            data: form.serialize(),
            success: function ( results ) {
                if ( results == 'failed:vote' ) {
                    movie.modalError( 'Failed to save vote to database.' )
                } if ( results == 'success:vote' ) {
                    movie.updateVotes()
                    movie.modalSuccess( 'You have successfully added your vote!' )
                }
            }
        } )
    }


}

module.exports = functions
