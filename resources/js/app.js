window._ = require( 'lodash' )

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require( 'jquery' )
    window.Popper = require( 'popper.js' ).default
    window.bootstrap = require( 'bootstrap' )
    window.movie = require( './movie' )
    window.search = require( './search' )
} catch ( e ) { }


// source: https://stackoverflow.com/a/17989377/5601253
$.fn.imagesLoaded = function () {
    // get all the images (excluding those with no src attribute)
    var $imgs = this.find( 'img[src!=""]' )
    // if there's no images, just return an already resolved promise
    if ( !$imgs.length ) { return $.Deferred().resolve().promise() }
    // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
    var dfds = []
    $imgs.each( function () {
        var dfd = $.Deferred()
        dfds.push( dfd )
        var img = new Image()
        img.onload = function () { dfd.resolve() }
        img.onerror = function () { dfd.resolve() }
        // img.onerror = function () { dfd.reject() } // Use if you want to handle .fail()
        img.src = this.src
    } )
    // return a master promise object which will resolve when all the deferred objects have resolved
    // IE - when all the images are loaded
    return $.when.apply( $, dfds )
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require( 'axios' )

window.axios.defaults.headers.common[ 'X-Requested-With' ] = 'XMLHttpRequest'

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
