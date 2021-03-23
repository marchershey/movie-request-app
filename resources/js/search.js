var functions = {

    reset: () => {
        $('#search-help').slideUp().text('')
        $('#movie-list').empty()
        $('#search-alert').slideUp().empty()
        $('#search-loading').fadeIn()
        $('#movie-list').slideUp()
    },

    alert: (text, type = 'primary') => {
        $alert = $('#search-alert')

        var html = `<div class="alert alert-${type} text-center" role="alert">
                        ${ text}
                    </div>`

        $alert.html(html).slideDown()
    },

    search: (term, token) => {
        $.ajax({
            type: "POST",
            url: '/api/search/movies',
            data: {
                '_token': token,
                'term': term
            },
            success: function (movies) {
                console.log(movies)
                var html = ''
                if (movies.total_results == 0) {
                    search.alert('Your search for <b>' + $.sanitize(term) + '</b> returned no results.', 'warning')
                } else {
                    $.each(movies.results, function (key, movie) {
                        var id = movie.id
                        var title = movie.title
                        var desc = movie.overview.replace(/\"/g, '') // remove double quotes from overviews (example: "a bug's life")
                        var poster = (movie.poster_path == null) ? 'https://i.imgur.com/yNRAnse.png' : process.env.MIX_TMDB_IMAGE_URL + movie.poster_path;


                        var trailer = (movie.youTubeTrailerId == null) ? '' : movie.youTubeTrailerId
                        html += `<div class="movie-item col-6 col-md-3 mb-3" data-tmdbid="${movie.tmdbId}" data-title="${movie.title}" data-year="${movie.year}" data-overview="${desc}" data-poster="${poster}" data-trailer="${trailer}" data-status="${movie.status}" data-monitored="${movie.monitored}" data-downloaded="${movie.downloaded}">
                                    <div class="card">`

                        if (movie.monitored) {
                            if (movie.downloaded) {
                                html += `<div class="ribbon-wrapper">
                                            <div class="ribbon ribbon-green">INSTALLED</div>
                                        </div>`
                            } else {
                                html += `<div class="ribbon-wrapper">
                                            <div class="ribbon ribbon-yellow">PROCESSING</div>
                                        </div>`
                            }
                        }

                        if (movie.status == 'announced') {
                            html += `<div class="ribbon-wrapper">
                                        <div class="ribbon ribbon-yellow">UPCOMING</div>
                                    </div>`
                        }

                        html += `<img src="${poster}" class="card-img-top img-fluid" alt="movie poster">
                            </div>
                        </div>`
                    })
                }

                $('#movie-list').append(html).imagesLoaded().then(function () {
                    $('#search-loading').slideUp()
                    $('#movie-list').slideDown()
                })
            },
            error: function (e) {
                console.log(e)
                $('#search-loading').slideUp()
                $('#movie-list').slideDown()
                search.alert('<strong>Error:</strong> Please refresh the page and try again.', 'danger')
            }
        })

    }

}

module.exports = functions
