<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Request;
use App\Models\Events;
use App\Models\Eventcategory;
use Response;
use Auth;
//use Carbon\Carbon;

class EventsController extends BaseSiteController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Events::orderBy('event_date','DESC')->where('active',1)->paginate(12);
		return view('site.events.index', compact('events'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$event = Events::findBySlug($slug);
		//$category = Eventcategory::find($event->category_id);

		//if  content not found
		if(!$event) return view('site.default-not-found');

		return view('site.events.show', compact('event'));
	}



}
