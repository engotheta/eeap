<?php

namespace App\Http\Controllers\site;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignsController extends BaseSiteController
{
    public function index()
	{
		$campaigns = Campaign::where('active',1)->orderBy('id','DESC')->paginate(5);
		return view('site.campaigns.index', compact('campaigns'));
	}


    public function show($slug)
    {
        $campaign = Campaign::findBySlug($slug);

        //if  content not found
		if(!$campaign) return view('site.default-not-found');

        return view('site.campaigns.show', compact('campaign'));
    }

}
