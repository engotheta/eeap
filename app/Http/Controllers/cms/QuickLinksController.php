<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\QuickLink;

use Response;
use Validator;
use Redirect;

class QuickLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if your want to use quicklink categories instead
        //return redirect('cms/quicklink-categories');

        $links = QuickLink::orderBy('id', 'DESC')->get();
        return view('cms.quick_links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.quick_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(QuickLink::$rules);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        // dd($inputs);

        $link = QuickLink::create($inputs);

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

        $link = QuickLink::find($id);      
        
        return view("cms.quick_links.edit", compact('link'));
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
        $request->validate(QuickLink::$rules);

        $link = QuickLink::find($id);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        // dd($inputs);

        $link->update($inputs);

        //if you want to categories instead
        //return redirect('cms/quicklink-categories/'.$link->category->slug); 

        return redirect('cms/quick_links');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = QuickLink::destroy($id);

        return redirect('cms/quick_links');
    }

}
