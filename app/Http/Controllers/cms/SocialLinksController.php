<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SocialLink;

use Response;
use Validator;
use Redirect;

class SocialLinksController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = SocialLink::orderBy('id', 'DESC')->get();

        $social_media = [
	        'facebook' => 'Facebook',
	        'twitter' => 'Twitter',
            'youtube' => 'Youtube',
	        'instagram' => 'Instagram',
	        'vimeo' => 'Vimeo',
	        'linkedIn' => 'LinkedIn',
	        'whatsApp' => 'WhatsApp',
	        'tumblr' => 'Tumblr',
	        'snapchat' => 'Snapchat',
	        'Flickr' => 'Flickr',
            'skype'=>'Skype'
        ];

        foreach ($links as $key => $value) {
        	//$value->title =  $social_media[$value->title];
        }

        return view('cms.social_links.index', compact('links', 'social_media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.social_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), SocialLink::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $link = SocialLink::create($request->all());

        if($link){
            return back()->with('status','success');
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
        $link = SocialLink::find($id);

        $social_media = [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'youtube' => 'Youtube',
            'instagram' => 'Instagram',
            'google-plus'=>'Google Plus'
        ];

        return view("cms.social_links.edit", compact('link', 'social_media'));
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
        $validator = Validator::make($request->all(), SocialLink::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $link = SocialLink::find($id);

        if($link->update($request->all())){
          return back()->with('status','success');
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
        $link = SocialLink::destroy($id);

        return back()->with('status','success');
    }

}
