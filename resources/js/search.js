var functions = {
    run: (query) => {
        search.reset()
        $.getJSON('https://api.themoviedb.org/3/search/movie', { api_key: api.tmdbKey, query: query })
            .done(function (data) {
                if (data.total_results > 0) {
                    movie.buildList(data.results)
                } else {
                    search.failed('No movies found. Make sure you spelled it correctly.')
                }
            })
            .fail(function (jqxhr, textStatus, error) {
                search.failed('The API call failed to return any movies.')
            }).always(function (data) {
                //
            })
    },

    reset: () => {
        $('.error').slideUp()
        $('.movie-list').empty()
    },

    failed: (text) => {
        if ($('.error').is(":visible")) {
            $('.error').slideUp('fast', function () {
                $('.error-text').html(text)
                $(this).slideDown()
            })
        } else {
            $('.error-text').html(text)
            $('.error').slideDown()
        }
    }
}

module.exports = functions
