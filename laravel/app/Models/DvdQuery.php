<?php namespace App\Models;

use DB;

class DvdQuery{

	public function search($term, $genre, $rating){
		$query = DB::table('dvds')
		->join('sounds','sounds.id','=','dvds.sound_id')
		->join('formats','formats.id','=','dvds.format_id')
		->join('genres','genres.id','=','dvds.genre_id')		
		->join('ratings','ratings.id','=','dvds.rating_id')
		->join('labels','labels.id','=','dvds.label_id');


		if($query && $genre == 'All' && $rating == 'All'){
			$query->where('title', 'like','%'. $term .'%');
		}
		else if($query && $genre == 'All'){
			$query->where('title', 'like','%'. $term .'%')
			->where('rating_name', '%'. $rating .'%');
		}
		else if($query && $rating == 'All'){
			$query->where('title', 'like','%'. $term .'%')
			->where('genre_name', '=', '%'. $genre .'%');;
		}
		else{
			$query->where('title', 'like','%'. $term .'%')
			->where('genre_name', '=', '%'. $genre .'%')
			->where('rating_name', '=', '%'. $rating .'%');
		}

		$query->orderBy('title', 'asc');


		
		return $query->get();
	}
} 
?>