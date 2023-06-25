<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\QuicklinkCategory;
use App\Models\QuickLink;
use App\Models\Menu;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use DB;

class QuicklinkCategoriesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = QuicklinkCategory::orderBy('id', 'DESC')->with('quicklinks')->get();
        return view('cms.quicklink-categories.index', compact('categories'));
    }


    public function show($slug)
    {
        $category = QuicklinkCategory::findBySlug($slug);
        $categories = QuicklinkCategory::orderBy('id', 'DESC')->where('id','!=',$category->id )->with('quicklinks')->get();
        $selectMenu = Menu::selectMenu();
        //dd($categories);
        return view('cms.quicklink-categories.show', compact('categories','category', 'selectMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.quicklink-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(QuicklinkCategory::$rules);

        $inputs = $request->except('banner_img');

        if($request->get('banner_img')){
            $image = $request->get('banner_img'); // base64 image 
        
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $imageName = md5(date('Ymdhis'));
            $imageName = $imageName.".".$type;

            $path = public_path().'/uploads/banners/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['banner_img'] = $imageName;
        }

        $category = QuicklinkCategory::create($inputs);

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
        $category = QuicklinkCategory::find($id);

        return view("cms.quicklink-categories.edit", compact('category'));
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
        $request->validate(QuicklinkCategory::$rules);

        $category = QuicklinkCategory::find($id);

        $inputs = $request->except('banner_img');

        if($request->get('banner_img')){

            if(is_file(public_path().'/uploads/banners/'.$category->banner_img) and file_exists(public_path().'/uploads/banners/'.$category->banner_img)){
                unlink(public_path().'/uploads/banners/'.$category->banner_img);
            }

            $image = $request->get('banner_img'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/banners/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['banner_img'] = $imageName;

        }

        $category->update($inputs);

        if($category){
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
        $category = QuicklinkCategory::find($id);
        // $quicklinks = QuickLink::where('category_id','=',$id)->get();
        
        if(is_file(public_path().'/uploads/banners/'.$category->banner_img) and file_exists(public_path().'/uploads/banners/'.$category->banner_img)){
            unlink(public_path().'/uploads/banners/'.$category->banner_img);
        }

        $category->quicklinks()->delete();
        $category->delete();

        if($category){
            return back()->with('status', 'success');
        }
    }

}
