<?php namespace App\Models;

use DB;

class DvdQuery{

	public function search($term, $genre, $rating){
		$query = DB::table('dvds')
		->join('sounds','sounds.id','=','dvds.sound_id')
		->join('formats','formats.id','=','dvds.format_id')
		->join('genres','genres.id','=','dvds.genre_id')		
		->join('ratings','ratings.id','=','dvds.rating_id')
		->join('labels','labels.id','=','dvds.label_id')
		->select(DB::raw('DATE_FORMAT(release_date,"%W %D %M %Y") as release_date, title, rating_name, genre_name, label_name, sound_name, format_name'));


		if($query && $genre == 'All' && $rating == 'All'){
			$query->where('title', 'like','%'. $term .'%');
		}
		else if($query && $genre == 'All'){
			$query->where('title','like','%'. $term .'%')
			->where('rating_name', $rating);
		}
		else if($query && $rating == 'All'){
			$query->where('title', 'like','%'. $term .'%')
			->where('genre_name', $genre);
		}
		else if ($query){
			$query->where('title', 'like','%'. $term .'%')
			->where('genre_name', $genre)
			->where('rating_name', $rating);
		}

		$query->orderBy('title', 'asc');
		
		return $query->get();
	}

	public function searchRating(){
		$query = DB::table('ratings')
		->select('rating_name');
		
		$query->orderBy('rating_name', 'asc');
		
		return $query->get();
	}

	public function searchGenre(){
		$query = DB::table('genres')
		->select('genre_name');
		
		$query->orderBy('genre_name', 'asc');
		
		return $query->get();
	}
} 
?>