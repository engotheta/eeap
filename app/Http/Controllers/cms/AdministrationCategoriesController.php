<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AdministrationCategories;
use App\Models\AdministrationCategoriesMembers;
use App\Models\Translation;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Response;
use Validator;
use Redirect;
use DB;

class AdministrationCategoriesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = AdministrationCategories::orderBy('id', 'DESC')->get();
        return view('cms.administration-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
        //This is for the old show that uses Gridstack to render, uncomment it and rename old_show.blade to show.blade in views to use it
        $members = Administration::all();
        $translations = Translation::all();
        $category = AdministrationCategories::find($id);
        return view('cms.administration-categories.show',compact('category','members','translations'));
        */

        $category = AdministrationCategories::find($id);
        $administration = Administration::orderBy('fullname','ASC')->pluck('fullname', 'id');
        $members = AdministrationCategoriesMembers::where('category_id', $id)->orderBy('position', 'ASC')->with('member')->get();
        return view('cms.administration-categories.show',compact('category','members', 'administration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), AdministrationCategories::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $category = AdministrationCategories::create($request->all());

        //due to conflict brought by two package working together translation and slugable you have to save slug again

        if($category){
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
        $category = AdministrationCategories::find($id);

        return view("cms.administration-categories.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $category = AdministrationCategories::find($id);
        $category->update($request->all());

        //return Response::json($category);
        return back()->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = AdministrationCategories::find($id);
        $category->category_members()->delete();
        $category->delete();
        return back()->with('status', 'success');
    }

}