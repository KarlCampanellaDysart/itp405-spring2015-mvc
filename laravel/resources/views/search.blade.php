@extends('layout')
@section('content')
	<div class="jumbotron">
		<div class="container">
			<h1>DVD Search</h1>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-9">
		<form action="/dvds">
			<div class="form-group">
				<label>Title</label>
				<input class="form-control" type="text" name="movie_title">
			</div>
			<div class="form-group">
				<label>Genres</label>
				<select class="form-control" name="genre">
					<option>All</option>				
					@foreach($genres as $genre) 
						<option>{{ $genre->genre_name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Ratings</label>
				<select class="form-control" name="rating">	
					<option>All</option>			
					@foreach($ratings as $rating) 
						<option> {{ $rating->rating_name }} </option>
					@endforeach
				</select>
			</div>			
			<input type="submit" value="Search">
		</form>
		</div>
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
			<h3>Genres</h3>
            <ul class="nav">
            	@foreach($genres as $genre)
            		<li>
            			<form action="{{ url('genres/$genre->genre_name/dvds') }}">
	            			<input name="genre" value="{{ $genre->genre_name }}" type="hidden">
							<button class="btn btn-link" type="submit">
								{{ $genre->genre_name }}
							</button>
            			</form>
            		</li>
              	@endforeach
            </ul>
        </div>
	</div>
@stop
