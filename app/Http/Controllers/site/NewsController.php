<?php
namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Models\News;
use Cookie;

class NewsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news_list = News::orderBy('id', 'DESC')->where('active',1)->paginate(12);
        return view('site.news.index', compact('news_list'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$news = News::findBySlug($slug);

		//if  content not found
		if(!$news) return view('site.default-not-found');

		return view('site.news.show', compact('news'));
	}
	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function archive($slug)
	{
		try {
			$year_month = decrypt($slug);
			$splitter = explode('-',$year_month);
			$year = (int)$splitter[0];
			$month = (int)$splitter[1];
		} catch(\Exception $e){
			return view('site.default-not-found');
		}

		$news_list = News::orderBy('id', 'DESC')->where('active',1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->paginate(12);
        return view('site.news.archive', compact('news_list','year_month'));
	}

}
