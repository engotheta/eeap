<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Cardiac;
use App\Models\MenuItem;
use App\Models\CardiacCategory;
class SitemapController extends BaseSiteController {

	public function index()
	{
        //for left menu...
		$parent_field = MenuItem::select('parent','menu_id')->where('url', 'like', '%sitemap%')->first();
        $menu_siblings = [];
        if($parent_field) $menu_siblings = MenuItem::where([
                ['parent', '=',$parent_field->parent],
                ['menu_id', '=', $parent_field->menu_id]
            ])->orderBy('position','ASC')->get();
		
        return view('site.sitemap.index', compact('menu_siblings'));
    }

        /**
     * Display a listing of the site map.
     *
     * @return \Illuminate\Http\Response
     */
    public function xml()
    {
        $menus = MenuItem::where('parent','<>','0')->get();

        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
            <urlset 
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
            xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                <url>
                    <loc>'.url('/').'</loc>
                    <lastmod>'.date(DATE_W3C).'</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>1.00</priority>
                </url>
            ';

        foreach ($menus as $key => $value) {
            if(!empty($value->url) && $value->url != '#'){
                $xmlString.=
                    '<url>
                        <loc>'.url($value->url).'</loc>
                        <lastmod>'.date(DATE_W3C).'</lastmod>
                        <changefreq>daily</changefreq>
                        <priority>1.00</priority>
                    </url>';
            }
        }
        
    $xmlString.='</urlset>';

    $dom = new \DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xmlString);

    \File::delete(public_path().'/sitemap.xml');

    //Save XML as a file
    $dom->save(public_path().'/sitemap.xml');

        return 'Created Successful';
    }
	
}
