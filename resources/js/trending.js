var functions = {

    reset: () => {
        $('.movie-list').empty()
    },

    failed: (text) => {
        app.loadingDone($('.movie-list'))
        if ($('.error').is(":visible")) {
            $('.error').slideUp('fast', function () {
                $('.error-text').html(text)
                $(this).slideDown()
            })
        } else {
            $('.error-text').html(text)
            $('.error').slideDown()
        }
    },

    loadDaily: () => {
        trending.reset()
        $.getJSON('https://api.themoviedb.org/3/trending/movie/day', { api_key: api.tmdbKey })
            .done(function (daily) {
                if (daily.total_results > 0) {
                    movie.buildList(daily.results)
                } else {
                    trending.failed('Something went wrong, try again later.');
                }
            })
            .fail(function (jqxhr, textStatus, error) {
                trending.failed('The API call failed to return any movies.')
            }).always(function (data) {
                //
            })
    },

    loadWeekly: () => {
        trending.reset()
        $.getJSON('https://api.themoviedb.org/3/trending/movie/week', { api_key: api.tmdbKey })
            .done(function (weekly) {
                if (weekly.total_results > 0) {
                    movie.buildList(weekly.results)
                } else {
                    trending.failed('No movies found. Make sure you spelled it correctly.')
                }
            })
            .fail(function (jqxhr, textStatus, error) {
                trending.failed('The API call failed to return any movies.')
            }).always(function (data) {
                //
            })
    }
}

module.exports = functions
