<!DOCTYPE>
<html>
<head>
	<title>reviews</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

	<div class="jumbotron">
		<div class="container">
		<h1><?php echo $title ?></h1>
		<h6>Rated: <?php echo $rating_name ?></h6>
		<h6>Genre: <?php echo $genre_name ?></h6>
		<h6>Label: <?php echo $label_name ?></h6>
		<h6>Sound: <?php echo $sound_name ?></h6>
		<h6>Format: <?php echo $format_name ?> </h6>
		<h6>Release date: <?php echo $release_date ?> </h6>	
		</div>
	</div>

	<div class="container">
		
		<?php if (Session::has('success')) : ?>
			<div class="alert alert-success">
			<p><?php echo Session::get('success') ?></p>
			</div>
		<?php endif ?>
		
		<?php foreach ($errors->all() as $error) : ?>
			<div class="alert alert-danger">
			<p><?php echo $error ?></p>
			</div>
		<?php endforeach ?>
	</div>

	<div class="container">
		<h2>Reviews</h2>
	</div>

	<div class="container">
	<table class="table">
		<thead>
			<tr>				
				<th>Title</th>
				<th>Description</th>
				<th>Rating</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reviews as $review) : ?>
				<tr>
					<td><?php echo $review->title ?></td>
					<td><?php echo $review->description ?></td>
					<td><?php echo $review->rating ?></td>
				</tr>	
			<?php endforeach ?>			
		</tbody>
	</table>
	</div>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Add a new review</h4>
			</div>
			<div class="panel-body">
				<form method="post" action="<?php echo url("dvds") ?>">
					<input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
					<input type="hidden" name="dvd_id" value="<?php echo $dvd_id ?>"/>
					<div class="form-group">
						<label>Title</label>		
						<input name="title" class="form-control" value="<?php echo Request::old('title') ?>">
					</div>
					<div class="form-group">
						<label>Description</label>
						<input name="description" class="form-control" value="<?php echo Request::old('description') ?>">
					</div>
					<div class="form-group">
						<label>Rating</label>						
						<select name="rating" class="form-control">
							<?php foreach ($nums as $num) : ?>
								<?php if ($num == Request::old('rating')) : ?>
									<option selected="1" value="<?php echo $num ?>"><?php echo $num ?></option>
								<?php else : ?>
									<option value="<?php echo $num ?>"><?php echo $num ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>						
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>	
	</div>

</body>
</html>