<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page_category;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class PageCategoriesController extends BaseController {

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Page_category::orderBy('id','DESC')->get();
        return view('cms.page_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Page_category::$rules);

        $category = Page_category::create($request->all());


        if($category){
            return redirect()->route('cms.page-categories.index');
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
        $category = Page_category::findOrFail($id);

        return view("cms.page_categories.edit", compact('category'));
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
        $request->validate(Page_category::$rules);

        $category = Page_category::find($id);

        $category->update($request->all());

        return redirect()->route('cms.page-categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Page_category::destroy($id);

        return redirect()->route('cms.page-categories.index');
    }

}
