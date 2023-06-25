<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;
use App\Models\HowDoI;

use Auth;
use Image;

class HowDoIsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $howdois = HowDoI::orderBy('id', 'DESC')->get();

        return view('cms.howdois.index', compact('howdois'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.howdois.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(HowDoI::$rules);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $howdoi = HowDoI::create($data);

        if($howdoi){
            return redirect('cms/howdois')->with('status','success');
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
        $howdoi = HowDoI::find($id);
        return view("cms.howdois.edit", compact('howdoi'));
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
    	$howdoi = HowDoI::find($id);

        $request->validate(HowDoI::$rules);

        $data = $request->all();

        $howdoi->update($data);

        return redirect('cms/howdois')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    	HowDoI::destroy($id);

        return redirect('cms/howdois')->with('status','success');
    }

}
