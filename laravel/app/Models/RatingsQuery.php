<?php namespace App\Models;

use DB;

class RatingsQuery{

	public function search(){
		$query = DB::table('ratings')
		->select('rating_name');
		
		$query->orderBy('rating_name', 'asc');
		
		return $query->get();
	}
} 
?>