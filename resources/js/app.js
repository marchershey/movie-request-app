window._ = require('lodash')

try {
    window.$ = window.jQuery = require('jquery')
    window.Popper = require('popper.js').default
    window.bootstrap = require('bootstrap')
    window.fa = require('@fortawesome/fontawesome-free/js/all');
    window.movie = require('./movie')
    window.search = require('./search')
} catch (e) { }


// source: https://stackoverflow.com/a/17989377/5601253
$.fn.imagesLoaded = function () {
    // get all the images (excluding those with no src attribute)
    var $imgs = this.find('img[src!=""]')
    // if there's no images, just return an already resolved promise
    if (!$imgs.length) { return $.Deferred().resolve().promise() }
    // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
    var dfds = []
    $imgs.each(function () {
        var dfd = $.Deferred()
        dfds.push(dfd)
        var img = new Image()
        img.onload = function () { dfd.resolve() }
        img.onerror = function () { dfd.resolve() }
        // img.onerror = function () { dfd.reject() } // Use if you want to handle .fail()
        img.src = this.src
    })
    // return a master promise object which will resolve when all the deferred objects have resolved
    // IE - when all the images are loaded
    return $.when.apply($, dfds)
}

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
