<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AboutLink;

use Response;
use Validator;
use Redirect;

class AboutLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = AboutLink::orderBy('id', 'DESC')->get();
        return view('cms.about_links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.about_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(AboutLink::$rules);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link = AboutLink::create($inputs);

        if($link){ 
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
        $link = AboutLink::find($id);      
        
        return view("cms.about_links.edit", compact('link'));
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
        $request->validate(AboutLink::$rules);

        $link = AboutLink::find($id);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link->update($inputs);

        return redirect('cms/about_links');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = AboutLink::destroy($id);

        return redirect('cms/about_links');
    }

}
