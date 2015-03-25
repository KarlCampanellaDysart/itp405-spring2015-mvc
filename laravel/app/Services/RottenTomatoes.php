<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;

class RottenTomatoes{
	public function search($dvd_title){
		//get json data from rotten tomatoes		
		$title = urlencode($dvd_title);

		if(Cache::has("rt-$title")){
			$jsonString = Cache::get("rt-$title");
		}
		else{
			$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=g4epue8vtu97jut8h3u4txeh&q=$title";
			$jsonString = file_get_contents($url);
			Cache::put("rt-$title", $jsonString, 60);
		}
		
		return json_decode($jsonString);
	}
}

 ?>