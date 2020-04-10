var functions = {
    loadingStart: ( $div ) => {
        $( '.loading' ).show()
        $div.hide()
    },
    loadingDone: ( $div ) => {
        num = Math.floor( Math.random() * ( 1000 - 500 ) ) + 500
        setTimeout( function () {
            $div.slideDown( 'slow' )
            $( '.loading' ).slideUp( 'slow' )
        }, num )
    }

}

module.exports = functions
