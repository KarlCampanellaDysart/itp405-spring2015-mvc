@extends('layout')
@section('content')

	<div class="jumbotron">
		<div class="container">
			<div class="row">
				@if ($rtReviewData != null)
					<div class="col-sm-2">
						<img style="width: 100%" src="{{ $rtReviewData->posters->original }}">
					</div>
				@endif
				<div class="col-sm-6">	
					<h1>{{ $title }}</h1>			
					<h5>Rated: {{ $rating_name }}</h5>
					<h5>Genre: {{ $genre_name }}</h5>
					<h5>Label: {{ $label_name }}</h5>
					<h5>Sound: {{ $sound_name }}</h5>
					<h5>Format: {{ $format_name }}</h5>
					<h5>Release date: {{ $release_date }}</h5>	
				</div>

			</div>
		</div>
	</div>

	
	<div class="container">		
		@if (Session::has('success')) 
			<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
			</div>
		@endif 
		
		@foreach ($errors->all() as $error) 
			<div class="alert alert-danger">
			<p>{{ $error }}</p>
			</div>
		@endforeach 
	</div>

	@if ($rtReviewData == null)
		<div class="container">
			<h2>Rotten Tomatoes Reviews</h2>
			<h5>{{ $title }} was not found in Rotten Tomatoes database.</h5>
		</div>
	@else
		<div class="container">
			<h2>Rotten Tomatoes Reviews</h2>
				<h4>Runtime: {{ $rtReviewData->runtime }}</h4>
				<h4>Cast: @foreach ($rtReviewData->abridged_cast as $cast){{ $cast->name }}, @endforeach </h4>
				<h4>Critic's score: {{ $rtReviewData->ratings->critics_score }}</h4>
				<h4>Audience's score: {{ $rtReviewData->ratings->audience_score }}</h4>
				

		</div>
	@endif

	<br>

	<div class="container">
		<h2>User Reviews</h2>
		<table class="table">
			<thead>
				<tr>				
					<th>Title</th>
					<th>Description</th>
					<th>Rating</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reviews as $review) 
					<tr>
						<td>{{ $review->title }}</td>
						<td>{{ $review->description }}</td>
						<td>{{ $review->rating }}</td>
					</tr>	
				@endforeach 		
			</tbody>
		</table>
	</div>

	<br>
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Add a new review</h4>
			</div>
			<div class="panel-body">
				<form method="post" action=" {{ URL::route('storeReview') }} ">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="dvd_id" value="{{ $dvd_id }}"/>
					<div class="form-group">
						<label>Title</label>		
						<input name="title" class="form-control" value="{{ Request::old('title') }}">
					</div>
					<div class="form-group">
						<label>Description</label>
						<input name="description" class="form-control" value="{{ Request::old('description') }}">
					</div>
					<div class="form-group">
						<label>Rating</label>						
						<select name="rating" class="form-control">
							@foreach ($nums as $num) 
								@if ($num == Request::old('rating')) 
									<option selected="1" value="{{ $num }}">{{ $num }}</option>
								@else 
									<option value="{{ $num }}">{{ $num }}</option>
								@endif 
							@endforeach
						</select>						
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>	
	</div>


@stop