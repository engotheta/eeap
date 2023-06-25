<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PressRelease;

class PressReleasesController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$press_releases = PressRelease::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.press_releases.index', compact('press_releases'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$press_release = PressRelease::findBySlug($slug);
		//if  content not found
		if(!$press_release) return view('site.default-not-found');

		return view('site.press_releases.show', compact('press_release'));
	}

	

}
