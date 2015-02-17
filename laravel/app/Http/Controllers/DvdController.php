<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;
use App\Models\GenreQuery;
use App\Models\RatingsQuery;

class DvdController extends Controller {

	public function search(){

		$dvdQuery = new DvdQuery();
		$genres = $dvdQuery->searchGenre();
		$ratings = $dvdQuery->searchRating();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	public function results(Request $request){

		//access to the model
		$dvds = (new DvdQuery())->search($request->input('movie_title'), $request->input('genre'), $request->input('rating'));

		if(!$request->input('movie_title')){
			//return redirect('/dvds/search');
			$dvds = (new DvdQuery())->search('', 'All', 'All');
			return view('results', [
			'movie_title' => '',
			'dvds' => $dvds
		]);
		}
		
		//passing varables to the view
		return view('results', [
			'movie_title' => $request->input('movie_title'),
			'dvds' => $dvds
		]);
	}
}