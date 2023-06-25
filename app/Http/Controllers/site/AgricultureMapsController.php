<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Request;
use App\Models\AgricultureMap;
use Response;
use Auth;
//use Carbon\Carbon;

class AgricultureMapsController extends BaseSiteController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$agricultureMaps = AgricultureMap::orderBy('id','DESC')->where('active',1)->paginate(12);
		return view('site.agriculture-maps.index', compact('agricultureMaps'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$agricultureMap = AgricultureMap::findBySlug($slug);

		//if  content not found
		if(!$agricultureMap) return view('site.default-not-found');

		return view('site.agriculture-maps.show', compact('agricultureMap'));
	}



}
