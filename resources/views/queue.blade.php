@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <h1 class="text-center font-weight-bold">Queue List</h1>
            <p class="text-center text-muted">Movies that are downloading.</p>
            {{-- <div class="alert alert-info text-center" role="alert">
                <strong>Note:</strong> The list below is ordered by <strong>votes</strong>. The movies with the most votes get added first. Tap/click on a movie to vote on it.
            </div> --}}
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body pb-0">
                    <div id="movie-list" class="">


                        @if(count($queue) > 0)
                        @foreach($queue as $q)
                        @php
                        $percentage = ($q['sizeleft'] == 0) ? '0' : 100 - (round(($q['sizeleft'] / $q['size']) * 100, 1));
                        $status = ($q['sizeleft'] == 0) ? '<em>Searching...</em>' : $q['status'];
                        $timeleft = ($q['sizeleft'] == 0 || $q['status'] == 'Paused') ? '<em>not available</em>' : '<span class="timeleft" value="">'.$q['estimatedCompletionTime'].'</span>';
                        $size = ($q['sizeleft'] == 0) ? '<em>not available</em>' : round($q['size'] * .000000001, 2) . 'GB';
                        $requester = App\Event::firstWhere('tmdbid', $q['movie']['tmdbId']);
                        $requester = (!$requester->anonymous) ? $requester->user->name : 'Anonymous';
                        $trailer = '';
                        @endphp
                        <div class="movie-item no-grow row mb-3" data-id="" data-tmdb-id="{{$q['movie']['tmdbId']}}" data-title="{{$q['movie']['title']}}" data-desc="{{$q['movie']['overview']}}" data-year="{{$q['movie']['year']}}" data-poster="{{$q['movie']['images'][0]['url']}}">
                            <div class="col-4 col-xl-3">
                                <img src="{{$q['movie']['images'][0]['url']}}" class="img-thumbnail img-fluid">
                            </div>
                            <div class="col-8 col-xl-9">
                                <h4 class="text-truncate">{{$q['movie']['title']}}</h4>

                                <div class="mt-3">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                                    </div>
                                </div>

                                <div class="info">
                                    <span><strong>Status:</strong> {!! $status !!}</span><br>
                                    <span><strong>Time Left:</strong> {!! $timeleft !!}</span><br>
                                    <span><strong>Size:</strong> {!! $size !!} <small class="text-muted">({{ $q['quality']['quality']['name'] }})</small></span><br>
                                    <hr>
                                    <span><strong>Requested by:</strong> <span class="text-capitalize">{!! $requester !!}</span></span><br>

                                </div>

                            </div>
                        </div>
                        @if(count($queue) > 1)
                        <hr>
                        @endif
                        @endforeach
                        @else
                        <div class="col">
                            <p class="text-center font-weight-bold">
                                No movies in the queue.
                            </p>
                            <p class="text-center">
                                You can request a movie by <a href="{{route('index.search')}}">searching</a> or checking out the <a href="{{route('index.trending')}}">trending</a> page.
                            </p>
                        </div>
                        @endif




                        {{-- @if(count($queue) > 0)
                        @foreach($queue as $q)
                        <div class="movie-item col-4 col-lg-2 mb-3" data-id="" data-tmdb-id="{{$q['movie']['tmdbId']}}" data-title="{{$q['movie']['title']}}" data-desc="{{$q['movie']['overview']}}" data-year="{{$q['movie']['year']}}" data-poster="{{$q['movie']['images'][0]['url']}}" data-trailer="{{$q['movie']['youTubeTrailerId']}}">
                        <img src="{{$q['movie']['images'][0]['url']}}" alt="" class="img-thumbnail img-fluid">
                    </div>
                    @endforeach
                    @else
                    <div class="col">
                        <p class="text-center font-weight-bold">
                            No movies in the queue.
                        </p>
                        <p class="text-center">
                            You can request a movie by <a href="{{route('index.search')}}">searching</a> or checking out the <a href="{{route('index.trending')}}">trending</a> page.
                        </p>
                    </div>
                    @endif --}}
                </div>
                <div class="d-flex justify-content-center">
                    {{-- {{$queues->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('inc.modals.movie')
@endsection

@push('scripts')
<script>
    $('.timeleft').text(function(index, value) {
        return moment().to(value, true);
    })

    $( '.movie-item' ).on( 'click', function () {
        var $movie = $( this )
        var id = $movie.data( 'id' )
        var tmdb = $movie.data( 'tmdb-id' )
        var title = $movie.data( 'title' )
        var year = $movie.data( 'year' )
        var desc = $movie.data( 'desc' )
        var poster = $movie.data( 'poster' )
        var trailer = $movie.data( 'trailer' )
        movie.openMovieModal( id, tmdb, title, year, desc, poster, '', 'vote' )
    } )

</script>
@endpush