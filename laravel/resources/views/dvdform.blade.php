@extends('layout')

@section('content')
	<div class="jumbotron">
		<div class="container">
			<h1>create DVD</h1>
		</div>
	</div>

	<div class="container">
		
		@if (Session::has('success')) 
			<div class="alert alert-success">
			<p> {{Session::get('success')}} </p>
			</div>
		@endif
		
		@foreach ($errors->all() as $error) 
			<div class="alert alert-danger">
			<p>{{ $error }}</p>
			</div>
		@endforeach 
	</div>

	<div class="container">
		<form method="post" action="<?php echo URL::route('storeDvd') ?>">
			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
			<div class="form-group">
				<label>Title</label>
				<input class="form-control" type="text" name="movie_title">
			</div>
			<div class="form-group">
				<label>Label</label>
				<select class="form-control" name="label">		
					@foreach($labels as $label) 
						<option value='{{ $label->id }}'>
							{{ $label->label_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Sound</label>
				<select class="form-control" name="sound">		
					@foreach($sounds as $sound) 
						<option value='{{ $sound->id }}'>
							{{ $sound->sound_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Genre</label>
				<select class="form-control" name="genre">		
					@foreach($genres as $genre) 
						<option value='{{ $genre->id }}'>
							{{ $genre->genre_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Rating</label>
				<select class="form-control" name="rating">		
					@foreach($ratings as $rating) 
						<option value='{{ $rating->id }}'>
							{{ $rating->rating_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Format</label>
				<select class="form-control" name="format">		
					@foreach($formats as $format) 
						<option value='{{ $format->id }}'>
							{{ $format->format_name }}
						</option>
					@endforeach
				</select>
			</div>			
			<button type="submit" class="btn btn-default">Create</button>
		</form>
	</div>
@stop