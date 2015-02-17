<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;
use App\Models\GenreQuery;
use App\Models\RatingsQuery;

class DvdController extends Controller {

	public function search(){

		$genres = (new GenreQuery())->search();

		$ratings = (new RatingsQuery())->search();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	public function results(Request $request){

		if(!$request->input('movie_title')){
			return redirect('/dvds/search');
		}

		//access to the model
		$dvds = (new DvdQuery())->search($request->input('movie_title'), $request->input('genre'), $request->input('rating'));

		//how to dump
		//dd($songs);

		//passing varables to the view
		return view('results', [
			'movie_title' => $request->input('movie_title'),
			'dvds' => $dvds
		]);
	}
}