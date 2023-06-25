<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\QuickInfo;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Response;
use Validator;
use Redirect;
use Auth;

class QuickInfosController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quickinfos = QuickInfo::orderBy('id', 'DESC')->get();
        return view('cms.quickinfos.index', compact('quickinfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.quickinfos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(QuickInfo::$rules);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $quickinfo = QuickInfo::create($data);

        return redirect('cms/quickinfos')->with('status','success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quickinfo = QuickInfo::find($id);
        return view("cms.quickinfos.edit", compact('quickinfo'));
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
    	$quickinfo = QuickInfo::find($id);

    	$request->validate(QuickInfo::$rules);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $quickinfo->update($data);

        return redirect('cms/quickinfos')->with('status','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		QuickInfo::destroy($id);
        return redirect('cms/quickinfos')->with('status','success');
    }

}
