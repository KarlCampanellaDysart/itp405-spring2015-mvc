<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;
use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;
use App\Models\Dvd;

use App\Services\RottenTomatoes;

class DvdController extends Controller {

	public function search(){

		$dvdQuery = new DvdQuery();
		$genres = $dvdQuery->searchGenre();
		$ratings = $dvdQuery->searchRating();

		$genres = (new Genre())->all();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings,
			'genres' => $genres
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
		
		$rtData = (new RottenTomatoes())->search($request->input('title'));

		$rtReviewData = null;
		if($rtData->total == 0){}
		else{
			$rtReviewData = $rtData->movies[0];
			// array('rtRatings' => $rtData['movies'][0]['ratings'],
			// 'rtImage' => $rtData['movies'][0]['posters']['thumbnail'],
			// 'rtRuntime' => $rtData['movies'][0]['runtime'],
			// 'rtCast' => $rtData['movies'][0]['abridged_cast']);
		}

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
			'rtReviewData' => $rtReviewData
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

	public function storeDvd(Request $request){

		$dvd = new Dvd();

		$dvd->title = $request->input('movie_title');
		$dvd->label_id = $request->input('label');
		$dvd->sound_id = $request->input('sound');
		$dvd->genre_id = $request->input('genre');
		$dvd->rating_id = $request->input('rating');
		$dvd->format_id = $request->input('format');


		$dvd->save();

		//dd($dvd);
		return redirect()->back()->with('success', 'dvd successfully added.');
	}

	public function dvdForm(){

		$labels = (new Label())->all();
		$sounds = (new Sound())->all();
		$genres = (new Genre())->all();
		$ratings = (new Rating())->all();
		$formats = (new Format())->all();

		return view('dvdform',[
			'labels' => $labels,
			'sounds' => $sounds,
			'genres' => $genres,
			'ratings' => $ratings,
			'formats' => $formats
		]);
	}

	public function getDvdFromGenre(Request $request){

		$dvds = Dvd::with('genre', 'rating', 'label')
	    ->whereHas('genre', function($query) use ($request) {
	      $query->where('genre_name', '=', $request->input('genre'));
	    })
	    ->get();

		return view('dvdgenre', [
			'genre' => $request->input('genre'),
			'dvds' => $dvds
		]);
	}
}