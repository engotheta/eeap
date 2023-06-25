<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$hospitals = Hospital::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.hospitals.index', compact('hospitals'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$hospital = Hospital::findBySlug($slug);

		//if  content not found
		if(!$hospital) return view('site.default-not-found');

		return view('site.hospitals.show', compact('hospital'));
	}

	

}
