var functions = {

    reset: () => {
        $('#movie-list').empty()
        $('#search-loading').fadeIn()
        $('#movie-list').slideUp()
    },

    search: (term, token) => {
        console.log(term)
        $.ajax({
            type: "POST",
            url: './search/movies',
            data: {
                '_token': token,
                'term': term
            },
            success: function (movies) {
                var html = ''
                $.each(movies, function (key, movie) {
                    // var year = ( movie.release_date == null ) ? 'unknown' : movie.release_date.substr( 0, 4 )
                    var poster = (movie.remotePoster == null) ? 'https://i.imgur.com/yNRAnse.png' : movie.remotePoster
                    var trailer = (movie.youTubeTrailerId == null) ? '' : movie.youTubeTrailerId
                    // var installed = ()
                    html += `
                    <div class="movie-item col-6 col-md-3 mb-3" data-tmdbid="${ movie.tmdbId }" data-title="${ movie.title }" data-year="${ movie.year }" data-overview="${ movie.overview }" data-poster="${ poster }" data-trailer="${ trailer }" data-status="${ movie.status }" data-monitored="${ movie.monitored }" data-downloaded="${ movie.downloaded }">
                        <div class="card">`

                    if (movie.monitored) {
                        if (movie.downloaded) {
                            html += `
                            <div class="ribbon-wrapper">
                                <div class="ribbon ribbon-green">INSTALLED</div>
                            </div>`
                        } else {
                            html += `
                            <div class="ribbon-wrapper">
                                <div class="ribbon ribbon-yellow">PROCESSING</div>
                            </div>`
                        }
                    }

                    if (movie.status == 'announced') {
                        html += `
                        <div class="ribbon-wrapper">
                            <div class="ribbon ribbon-yellow">UPCOMING</div>
                        </div>`
                    }

                    html += `<img src="${ poster }" class="card-img-top img-fluid" alt="movie poster">
                            </div>
                        </div>
                    </div>`
                })
                $('#movie-list').append(html).imagesLoaded().then(function () {
                    $('#search-loading').slideUp()
                    $('#movie-list').slideDown()
                })
            }
        })

    }

}

module.exports = functions
