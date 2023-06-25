<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Campaigns\SlugCampaign;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\SpecialPage;

use Image;

class CampaignsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'DESC')->get();
        $specials = SpecialPage::pluck('title_en', 'id');

        return view('cms.campaigns.index', compact('campaigns','specials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specials = SpecialPage::pluck('title_en', 'id');

        return view('cms.campaigns.create',compact('specials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Campaign::$rules);

        $data = $request->except('photo_url','icon');

        // if ($request->hasFile('icon'))
        // {
        //     if ($request->file('icon')->isValid())
        //     {
        //         $icon_url = $request->file('icon');

        //         $icon_name = 'icon-'.time();

        //         $pathName = '/uploads/campaigns/';

        //         $destinationPath = public_path().$pathName;

        //         $icon_url->move($destinationPath, $icon_name);

        //         $data['icon'] = $icon_name;

        //     }
        // }


        if ($request->get('photo_url')) {
            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/campaigns/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;
        }

        $campaign = Campaign::create($data);

        if($campaign){
            return redirect('cms/campaigns')->with('status','success');
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
        $campaign = Campaign::find($id);
        $specials = SpecialPage::pluck('title_en', 'id');

        return view("cms.campaigns.edit", compact('campaign','specials'));
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
    	$campaign = Campaign::find($id);

        $request->validate(Campaign::$rules_update);

        $data = $request->except('photo_url','icon');

        // if ($request->hasFile('icon'))
        // {
        //     if ($request->file('icon')->isValid())
        //     {
        //         $icon_url = $request->file('icon');

        //         $icon_name = 'icon-'.time();

        //         $pathName = '/uploads/campaigns/';

        //         $destinationPath = public_path().$pathName;

        //         if(is_file(public_path().'/uploads/campaigns/'.$campaign->icon) and file_exists(public_path().'/uploads/campaigns/'.$campaign->icon)){
        //             unlink(public_path().'/uploads/campaigns/'.$campaign->icon);
        //         }

        //         $icon_url->move($destinationPath, $icon_name);

        //         $data['icon'] = $icon_name;

        //     }
        // }

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/campaigns/'.$campaign->photo_url) and file_exists(public_path().'/uploads/campaigns/'.$campaign->photo_url)){
                unlink(public_path().'/uploads/campaigns/'.$campaign->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/campaigns/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;

        }

        $campaign->update($data);

        return redirect('cms/campaigns')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);

        // if(is_file(public_path().'/uploads/campaigns/'.$campaign->icon) and file_exists(public_path().'/uploads/campaigns/'.$campaign->icon)){
        //     unlink(public_path().'/uploads/campaigns/'.$campaign->icon);
        // }

        if(is_file(public_path().'/uploads/campaigns/'.$campaign->photo_url) and file_exists(public_path().'/uploads/campaigns/'.$campaign->photo_url)){
            unlink(public_path().'/uploads/campaigns/'.$campaign->photo_url);
        }

        $campaign->delete();
        
        return redirect('cms/campaigns')->with('status','success');
    }

}
