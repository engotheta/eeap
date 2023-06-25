<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Eventcategory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;

class EventsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            $availables= $ltr->availableLocales();
            dd($availables);
        */
        $events = Events::orderBy('id', 'DESC')->get();
     //   $categories = EventCategory::orderBy('id', 'ASC')->pluck('title_en','id')->toArray();
        return view('cms.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $categories = EventCategory::orderBy('id', 'ASC')->pluck('title_en','id')->toArray();

       // return view('cms.events.create', compact('categories'));
        return view('cms.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Events::$rules);

        $name = $request->input('active', '1');

        $inputs = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path = public_path().'/uploads/events/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $inputs['photo_url'] = $imageName;

        $events= auth()->user()->events()->save(new Events($inputs));

        if($events){
          return back()->with('status', 'success');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::find($id);
       // $categories = EventCategory::orderBy('id', 'ASC')->pluck('title_en','id')->toArray();
        return view("cms.events.edit", compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $events = Events::find($id);

        $request->validate(Events::$rules_update);

        $inputs = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/events/'.$events->photo_url) and file_exists(public_path().'/uploads/events/'.$events->photo_url)){
                unlink(public_path().'/uploads/events/'.$events->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/events/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['photo_url'] = $imageName;

        }

        $inputs['user_id'] = auth()->user()->id;

        $events->update($inputs);

        return back()->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $events = Events::find($id);

		if(is_file(public_path().'/uploads/events/'.$events->photo_url) and file_exists(public_path().'/uploads/events/'.$events->photo_url)){
			unlink(public_path().'/uploads/events/'.$events->photo_url);
        }

	    // if(is_file(public_path().'/uploads/events/thumb-'.$events->photo_url) and file_exists(public_path().'/uploads/events/thumb-'.$events->photo_url)){
		// 	unlink(public_path().'/uploads/events/thumb-'.$events->photo_url);
	    // }

	    // if(is_file(public_path().'/uploads/events/medium-'.$events->photo_url) and file_exists(public_path().'/uploads/events/medium-'.$events->photo_url)){
		// 	unlink(public_path().'/uploads/events/medium-'.$events->photo_url);
	    // }

        // if(is_file(public_path().'/uploads/events/large-'.$events->photo_url) and file_exists(public_path().'/uploads/events/large-'.$events->photo_url)){
        //     unlink(public_path().'/uploads/events/large-'.$events->photo_url);
        // }

        Events::destroy($id);

        //return redirect('cms/events');
        return back()->with('status', 'success');
    }

}
