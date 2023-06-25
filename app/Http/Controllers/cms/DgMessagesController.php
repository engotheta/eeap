<?php
namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DgMessage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Image;


class DgMessagesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dg_message = DgMessage::orderBy('id', 'DESC')->first();
        return view('cms.dg_messages.index', compact('dg_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.dg_messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(DgMessage::$rules);

        $data = $request->all();

        $dg_message = DgMessage::create($data);

        if($dg_message){
            return redirect('cms/dg_messages')->with('status','success');
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
        $dg_message = DgMessage::find($id);
        return view("cms.dg_messages.edit", compact('dg_message'));
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
        $dg_message = DgMessage::find($id);

        $request->validate(DgMessage::$rules);

        $data = $request->all();

        $dg_message->update($data);

        return redirect('cms/dg_messages')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DgMessage::destroy($id);
        return redirect('cms/dg_messages')->with('status','success');
    }

}
