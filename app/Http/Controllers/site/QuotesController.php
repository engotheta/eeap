<?php

namespace App\Http\Controllers\site;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotesController extends BaseSiteController
{
    public function index()
	{
        $quote = Quote::all()->first();
        return view('site.quotes.show', compact('quote'));

		$quotes = Quote::where('active',1)->orderBy('id','DESC')->paginate(10);
		return view('site.quotes.index', compact('quotes'));
	}


    public function show($slug)
    {
        $quote = Quote::findBySlug($slug);

        //if  content not found
		if(!$quote) return view('site.default-not-found');

        return view('site.quotes.show', compact('quote'));
    }

}
