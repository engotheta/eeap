<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Page_category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PagesController extends BaseController {

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::get();
        $categories = Page_category::all()->pluck('title','id');

        return view('cms.pages.index', compact('pages','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Page_category::all()->pluck('title','id')->toArray();
        return view('cms.pages.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Page::$rules);

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

        $page = Page::create($inputs);

        if($page){
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
        $page = Page::find($id);
        $categories = Page_category::all()->pluck('title_en','id');

        return view("cms.pages.edit", compact('page','categories'));
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
        $request->validate(Page::$rules);

        $page = Page::find($id);

        $inputs = $request->except('banner_img');

        if($request->get('banner_img')){

            if(is_file(public_path().'/uploads/banners/'.$page->banner_img) and file_exists(public_path().'/uploads/banners/'.$page->banner_img)){
                unlink(public_path().'/uploads/banners/'.$page->banner_img);
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

        $page->update($inputs);

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
        $page = Page::find($id);

        if(is_file(public_path().'/uploads/banners/'.$page->banner_img) and file_exists(public_path().'/uploads/banners/'.$page->banner_img)){
            unlink(public_path().'/uploads/banners/'.$page->banner_img);
        }

        Page::destroy($id);

        return back()->with('status', 'success');
    }

}
