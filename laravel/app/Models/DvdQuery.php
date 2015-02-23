<?php namespace App\Models;

use Validator;
use DB;

class DvdQuery{

	public function search($term, $genre, $rating){
		$query = DB::table('dvds')
		->join('sounds','sounds.id','=','dvds.sound_id')
		->join('formats','formats.id','=','dvds.format_id')
		->join('genres','genres.id','=','dvds.genre_id')		
		->join('ratings','ratings.id','=','dvds.rating_id')
		->join('labels','labels.id','=','dvds.label_id')
		->select(DB::raw('DATE_FORMAT(release_date,"%W %D %M %Y") as release_date, title, rating_name, genre_name, label_name, sound_name, format_name, dvds.id'));


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

	public function getTitles(){
		$query = DB::table('dvds')
		->select('title', 'dvds.id');

		$query->orderBy('title', 'asc');
		return $query->get();
	}

	public function getNumbers(){
		$nums = array('1','2','3','4','5','6','7','8','9','10');
		return $nums;
	}

	public function searchReviews($id){

		$query = DB::table('reviews')
		->select('title', 'description', 'rating')
		->where('dvd_id', $id);

		return $query->get();
	}

	public static function createReview($input)
	{
		DB::table('reviews')->insert($input);
	}

	public static function validate($input)
	{
		return Validator::make($input, [
			'title' => 'required|min:5',
			'description' => 'required|min:30',
			'rating' => 'required|integer|max:10|min:1',
			'dvd_id' => 'required|integer'
		]);
	}
} 
?>