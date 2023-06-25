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

class AdministrationCategoriesMembersController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //do nothing
    }
    
    public function create()
    {
        //do nothing
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //do nothing
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(AdministrationCategoriesMembers::$rules);

        $member = AdministrationCategoriesMembers::create($request->input());

        if($member){
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
        //do nothing
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
        $member = AdministrationCategoriesMembers::find($id);

        $request->validate(AdministrationCategoriesMembers::$rules);

        $member->update($request->input());

        if ($member) {
          return back()->with('status', 'success');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdministrationCategoriesMembers::destroy($id);

        return back()->with('status', 'success');
    }

}