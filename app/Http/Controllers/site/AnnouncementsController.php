<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$announcements = Announcement::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.announcements.index', compact('announcements'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$announcement = Announcement::findBySlug($slug);

		//if  content not found
		if(!$announcement) return view('site.default-not-found');

		return view('site.announcements.show', compact('announcement'));
	}

	

}
