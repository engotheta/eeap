<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ImportantLink;


class ImportantLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $links = ImportantLink::orderBy('id', 'DESC')->get();

        $links = ImportantLink::all();     
    
        return view('cms.important_links.index', compact('links'));
    }

    public function spanner($str){
        return str_replace(" ","",strtolower(trim($str)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.important_links.create');
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
        $request->validate(ImportantLink::$rules);

        $inputs = $request->all();

        $link = ImportantLink::create($inputs);

        return redirect('cms/important_links')->with('status','success');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = ImportantLink::find($id);

        return view("cms.important_links.edit", compact('link'));
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

        $link = ImportantLink::find($id);

        $request->validate(ImportantLink::$rules);

        $inputs = $request->all();

        $link->update($inputs);


        return redirect('cms/important_links')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = ImportantLink::destroy($id);

        return redirect('cms/important_links')->with('status','success');
    }

}
