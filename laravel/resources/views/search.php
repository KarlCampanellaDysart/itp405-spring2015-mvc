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
			<input type="text" name="movie_title">

			<label>Genres: </label>
			<select name="genre">
				<option>All</option>				
				<?php foreach($genres as $genre) : ?>
					<option><?php echo $genre->genre_name ?></option>
				<?php endforeach; ?>
			</select>

			<label>Ratings: </label>
			<select name="rating">	
				<option>All</option>			
				<?php foreach($ratings as $rating) : ?>
					<option><?php echo $rating->rating_name ?></option>
				<?php endforeach; ?>
			</select>

			<input type="submit" value="Search">
		</form>
	</div>

</body>
</html>