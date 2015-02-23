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

	public function reviews(Request $request){

		$reviews = (new DvdQuery())->searchReviews($request->input('id'));
		$titles = (new DvdQuery())->getTitles();
		$nums = (new DvdQuery())->getNumbers(); 

		return view('reviews',[
			'title' => $request->input('title'),
			'reviews' => $reviews,
			'dvd_id' => $request->input('id'),
			'titles' => $titles,
			'nums' => $nums,
			'rating_name' => $request->input('rating_name'),
			'genre_name' => $request->input('genre_name'),
			'label_name' => $request->input('label_name'),
			'sound_name' => $request->input('sound_name'),
			'format_name' => $request->input('format_name'),
			'release_date' => $request->input('release_date'),
		]);
	}

	public function storeReview(Request $request){
		$validator = DvdQuery::validate($request->all());

		if ($validator->passes()) {

			DvdQuery::createReview([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'dvd_id' => $request->input('dvd_id'),
				'rating' => $request->input('rating')
			]);

			return redirect()->back()->with('success', 'Review successfully added.');
		}

		return redirect()->back()->withErrors($validator)->withInput();
	}
}