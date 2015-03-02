@extends('layout')

@section('content')
	<div class="jumbotron">
		<div class="container">
		<h1>results</h1>
		<p>{{ $genre }}</p>
		</div>
	</div>
	<div class="container">

	<table class="table">
		<thead>
			<tr>				
				<th>Title</th>
				<th>Rating</th>
				<th>Genre</th>
				<th>Label</th>			
			</tr>
		</thead>
		<tbody>
			@foreach ($dvds as $dvd)
				<tr>
					<td>{{ $dvd->title }}</td>
					<td>{{ $dvd->rating->rating_name }}</td>
					<td>{{ $dvd->genre->genre_name }}</td>
					<td>{{ $dvd->label->label_name }}</td>
				</tr>	
			@endforeach			
		</tbody>
	</table>
	</div>
@stop