@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="lead mb-0">Missing Movies <span class="badge badge-primary align-text-top">{{$missing->total()}}</span> </p>
                    <p class="small text-muted">Movies that have been added to Radarr but have not been added to the database.</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="auto-add-missing">
                        <label class="custom-control-label text-muted" for="auto-add-missing">Automatically add movies to database</label>
                    </div>
                    <hr>
                    <div id="movielist-installed" class="row">

                        @foreach($missing as $movie)
                        <div class="movie-item col-6 col-md-2 mb-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/196x285" class="card-img-top img-fluid" alt="movie poster">
                                <div class="card-body font-weight-bold text-truncate text-center p-2">
                                    {{$movie->title}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
