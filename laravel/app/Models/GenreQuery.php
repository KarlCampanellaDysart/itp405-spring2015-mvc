<?php namespace App\Models;

use DB;

class GenreQuery{

	public function search(){
		$query = DB::table('genres')
		->select('genre_name');
		
		$query->orderBy('genre_name', 'asc');
		
		return $query->get();
	}
} 
?>