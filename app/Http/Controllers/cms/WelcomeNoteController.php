<?php
namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\WelcomeNote;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Image;


class WelcomeNoteController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcome = WelcomeNote::orderBy('id', 'DESC')->first();
        return view('cms.welcome.index', compact('welcome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.welcome.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(WelcomeNote::$rules);

        $data = $request->all();

        $welcome = WelcomeNote::create($data);

        if($welcome){
            return redirect('cms/welcome')->with('status','success');
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
        $welcome = WelcomeNote::find($id);

        return view("cms.welcome.edit", compact('welcome'));
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
        //dd($request->all());
        $welcome = WelcomeNote::find($id);

        $request->validate(WelcomeNote::$rules);

        $data = $request->all();

        $welcome->update($data);

        return redirect('cms/welcome')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
    	$welcome = WelcomeNote::find($id);

        WelcomeNote::destroy($id);

        return redirect('cms/welcome')->with('status','success');
    }

}
