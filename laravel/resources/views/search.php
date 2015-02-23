<!DOCTYPE>
<html>
<head>
	<title>DVD Search</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<h1>DVD Search</h1>
		</div>
	</div>
	<div class="container">
		<form action="/dvds">
			<div class="form-group">
				<label>Title</label>
				<input class="form-control" type="text" name="movie_title">
			</div>
			<div class="form-group">
				<label>Genres</label>
				<select class="form-control" name="genre">
					<option>All</option>				
					<?php foreach($genres as $genre) : ?>
						<option><?php echo $genre->genre_name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Ratings</label>
				<select class="form-control" name="rating">	
					<option>All</option>			
					<?php foreach($ratings as $rating) : ?>
						<option><?php echo $rating->rating_name ?></option>
					<?php endforeach; ?>
				</select>
			</div>			
			<input type="submit" value="Search">
		</form>
	</div>
</body>
</html>