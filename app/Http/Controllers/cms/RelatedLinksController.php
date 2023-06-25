<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\RelatedLink;


class RelatedLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = RelatedLink::orderBy('id', 'DESC')->get();
        return view('cms.related_links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.related_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate(RelatedLink::$rules);


        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link = RelatedLink::create($inputs);

        return redirect('cms/related_links')->with('status','success');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = RelatedLink::find($id);

        return view("cms.related_links.edit", compact('link'));
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

        $link = RelatedLink::find($id);

        $request->validate(RelatedLink::$rules);

        $inputs = $request->all();

        if($request->link == 0) {
            $inputs['url'] = $request->url_external;
        }else{
            $inputs['url_external'] = NULL;
        }

        $link->update($inputs);

        return redirect('cms/related_links')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = RelatedLink::destroy($id);

        return redirect('cms/related_links')->with('status','success');
    }

}
