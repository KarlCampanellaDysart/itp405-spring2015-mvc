<!DOCTYPE>
<html>
<head>
	<title>results</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

	<div class="jumbotron">
		<div class="container">
		<h1>results</h1>
		<p>You searched for <?php echo $movie_title ?></p>
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
				<th>Sound</th>
				<th>Format</th>
				<th>Release</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dvds as $dvd) : ?>
				<tr>
					<td><?php echo $dvd->title ?></td>
					<td><?php echo $dvd->rating_name ?></td>
					<td><?php echo $dvd->genre_name ?></td>
					<td><?php echo $dvd->label_name ?></td>
					<td><?php echo $dvd->sound_name ?></td>
					<td><?php echo $dvd->format_name ?></td> 
					<td><?php echo $dvd->release_date ?></td> 

					<td><form action="dvds/<?php echo $dvd->id ?>">
						<input name="title" value="<?php echo $dvd->title ?>" type="hidden"></input>
						<input name="id" value="<?php echo $dvd->id ?>" type="hidden"></input>

						<input name="rating_name" value="<?php echo $dvd->rating_name ?>" type="hidden"></input>
						<input name="genre_name" value="<?php echo $dvd->genre_name ?>" type="hidden"></input>
						<input name="label_name" value="<?php echo $dvd->label_name ?>" type="hidden"></input>
						<input name="sound_name" value="<?php echo $dvd->sound_name ?>" type="hidden"></input>
						<input name="format_name" value="<?php echo $dvd->format_name ?>" type="hidden"></input>
						<input name="release_date" value="<?php echo $dvd->release_date ?>" type="hidden"></input>

						<input type="submit" value="Reviews"></input>
					</form></td>
					
				</tr>	
			<?php endforeach ?>			
		</tbody>
	</table>
	</div>
</body>
</html>