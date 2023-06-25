<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Speech;

class SpeechesController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$speeches = Speech::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.speeches.index', compact('speeches'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$speech = Speech::findBySlug($slug);
		//if  content not found
		if(!$speech) return view('site.default-not-found');

		return view('site.speeches.show', compact('speech'));
	}

	

}
