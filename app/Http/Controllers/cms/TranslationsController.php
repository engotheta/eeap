<?php namespace App\Http\Controllers\cms;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Translation as Translation;
use Illuminate\Http\Request;

class TranslationsController  extends BaseController {


    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {

        $translations = Translation::orderBy('created_at','DESC')->get()->toArray();

        return view('cms.translations.index', compact('translations'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return Response
     */
    public function create()
    {
        return view('cms.translations.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Translation::create($request->all());

        return back()->with('status', 'success');
    }


    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function trans_update(Request $request)
    {

         foreach($request->keyword as $key=>$value){

            Translation::find($key)->update($value);
         }

         return back()->with('status', 'success');

        // return Redirect('cms/translations')->with(['success' => "Translations data updated successfully"]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id,Request $request)
    {
        Translation::destroy($id);

        return back()->with('status', 'success');
    }



}
