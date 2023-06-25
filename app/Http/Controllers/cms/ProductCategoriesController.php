<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use DB;

class ProductCategoriesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::orderBy('id', 'DESC')->withCount('products')->get();
        return view('cms.product_categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = ProductCategory::find($id);
        return view('cms.product_categories.show', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(ProductCategory::$rules);

        $data = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path_relative = '/uploads/product-categories/';
        $path = public_path().$path_relative;

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $data['photo_url'] = $path_relative.$imageName;

        $category = ProductCategory::create($data);

        return redirect()->route('cms.product_categories.index')->with('status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return view("cms.product_categories.edit", compact('category'));
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
        $request->validate(ProductCategory::$rules_update);

        $category = ProductCategory::find($id);

        $data = $request->except('photo_url');

        if($request->get('photo_url')){

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path_relative = '/uploads/product-categories/';
            $path = public_path().$path_relative;

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            if(is_file(public_path().$category->photo_url) and file_exists(public_path().$category->photo_url)){
                unlink(public_path().$category->photo_url);
            }

            $data['photo_url'] = $path_relative.$imageName;

        }

        $category->update($data);

        return redirect()->route('cms.product_categories.index')->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);

        if(is_file(public_path().$category->photo_url) and file_exists(public_path().$category->photo_url)){
            unlink(public_path().$category->photo_url);
        }

        foreach($category->products as $product){
            if(is_file(public_path().$product->photo_url) and file_exists(public_path().$product->photo_url)){
                unlink(public_path().$product->photo_url);
            }
        }

        $category->products()->delete();
        $category->delete();

        return back()->with('status', 'success');
    }

}
