<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$trainings = Training::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.trainings.index', compact('trainings'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$training = Training::findBySlug($slug);

		//if  content not found
		if(!$training) return view('site.default-not-found');

		return view('site.trainings.show', compact('training'));
	}

	

}
