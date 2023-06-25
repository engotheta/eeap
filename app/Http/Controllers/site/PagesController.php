<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SpecialPage;
use App\Models\MenuItem;

use Response;


class PagesController extends BaseSiteController {


    public function show($slug)
    {
        $page = Page::findBySlug($slug);

        //if  content not found
		if(!$page) return view('site.default-not-found');
      
        //for left menu...
		$parent_field = MenuItem::select('parent','menu_id')->where('url', 'like', '%pages/' . $slug . '%')->first();
        $menu_siblings = [];
        if($parent_field) $menu_siblings = MenuItem::where([
                ['parent', '=',$parent_field->parent],
                ['menu_id', '=', $parent_field->menu_id]
            ])->orderBy('position','ASC')->get();
        
        // dd($menu_siblings);
        return view('site.pages.show', compact('page','menu_siblings'));
    }

    public function special($slug)
    {
        $page = SpecialPage::findBySlug($slug);
        //if  content not found
		if(!$page) return view('site.default-not-found');

        return view('site.pages.special', compact('page'));
    }



}
