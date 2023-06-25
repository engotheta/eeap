<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HowDoI;

class HowDoIsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$howdois = HowDoI::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.howdois.index', compact('howdois'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$howdoi = HowDoI::findBySlug($slug);

		//if  content not found
		if(!$howdoi) return view('site.default-not-found');

		return view('site.howdois.show', compact('howdoi'));
	}

	

}
