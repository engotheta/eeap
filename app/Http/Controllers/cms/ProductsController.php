<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use DB;

class ProductsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->with('category')->get();
        return view('cms.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('cms.products.show', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::orderBy('id')->pluck('title_en', 'id');
        // dd($categories);
        return view('cms.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::$rules);

        $data = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path_relative = '/uploads/products/';
        $path = public_path().$path_relative;

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $data['photo_url'] = $path_relative.$imageName;

        $product = Product::create($data);

        return redirect()->route('cms.products.index')->with('status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::orderBy('id')->pluck('title_en', 'id');
        return view("cms.products.edit", compact('product', 'categories'));
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
        $request->validate(Product::$rules_update);

        $product = Product::find($id);

        $data = $request->except('photo_url');

        if($request->get('photo_url')){

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path_relative = '/uploads/products/';
            $path = public_path().$path_relative;

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            if(is_file(public_path().$product->photo_url) and file_exists(public_path().$product->photo_url)){
                unlink(public_path().$product->photo_url);
            }

            $data['photo_url'] = $path_relative.$imageName;

        }

        $product->update($data);

        return redirect()->route('cms.products.index')->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(is_file(public_path().$product->photo_url) and file_exists(public_path().$product->photo_url)){
            unlink(public_path().$product->photo_url);
        }

        $product->delete();

        return back()->with('status', 'success');
    }

}
