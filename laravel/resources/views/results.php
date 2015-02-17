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
		<?php var_dump($dvds) ?>
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
					<td><?php echo $dvd->DATE_FORMAT(release_date,'%W %D %M %Y') ?></td> 
				</tr>	
			<?php endforeach ?>			
		</tbody>
	</table>
	</div>
</body>
</html>