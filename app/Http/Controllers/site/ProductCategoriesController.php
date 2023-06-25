<?php

namespace App\Http\Controllers\site;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCategoriesController extends BaseSiteController
{
    public function index()
	{
		$categories = ProductCategory::where('active',1)->orderBy('id','DESC')->paginate(12);
		$products = Product::where('active',1)->orderBy('id','DESC')->with('category')->paginate(30);
		return view('site.product-categories.index', compact('categories','products'));
	}


    public function show($slug)
    {
        $category = ProductCategory::findBySlug($slug);

        //if  content not found
		if(!$category) return view('site.default-not-found');

        // get the products
        $products = Product::where('category_id', $category->id)->where('active',1)->orderBy('id', 'DESC')->paginate(12);
        return view('site.product-categories.show', compact('category','products'));
    }

    
	public function search(Request $request){
        $categories = ProductCategory::where('active',1)->orderBy('id','DESC')->paginate(12);
		$term = strip_tags($request->q);
		$products = Product::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('location', 'like', '%' . $term . '%')->orWhere('grade', 'like', '%' . $term . '%')->orWhere('season', 'like', '%' . $term . '%')->orderBy('id','DESC')->paginate(50);
		return view('site.product-categories.index', compact('categories','products','term'));
	}



    public function product($slug, $product_slug)
    {
        $category = ProductCategory::findBySlug($slug);
        $product = Product::findBySlug($product_slug);

        //if  product content not found
		if(!$product) return view('site.default-not-found');

        return view('site.product-categories.product', compact('category','product'));
    }

}
