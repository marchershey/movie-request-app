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
            url: './search/movies',
            data: {
                '_token': token,
                'term': term
            },
            success: function (movies) {
                var html = ''
                if (movies.length == 0) {
                    search.alert('The search returned no results. Check your spelling and try again.', 'warning')
                } else {
                    $.each(movies, function (key, movie) {
                        var desc = movie.overview.replace(/\"/g, '') // remove double quotes from overviews (example: "a bug's life")
                        var poster = (movie.remotePoster == null) ? 'https://i.imgur.com/yNRAnse.png' : movie.remotePoster
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
            error: function () {
                $('#search-loading').slideUp()
                $('#movie-list').slideDown()
                search.alert('<strong>Error:</strong> Please refresh the page and try again.', 'danger')
            }
        })

    }

}

module.exports = functions
