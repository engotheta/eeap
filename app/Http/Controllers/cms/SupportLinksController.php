<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SupportLink;

use Response;
use Validator;
use Redirect;

class SupportLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = SupportLink::orderBy('id', 'DESC')->get();
        return view('cms.support_links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.support_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(SupportLink::$rules);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link = SupportLink::create($inputs);

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
        $link = SupportLink::find($id);      
        
        return view("cms.support_links.edit", compact('link'));
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
        $request->validate(SupportLink::$rules);

        $link = SupportLink::find($id);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link->update($inputs);

        return redirect('cms/support_links');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = SupportLink::destroy($id);

        return redirect('cms/support_links');
    }

}
