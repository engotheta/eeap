<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\News;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use Validator;

class NewsController extends BaseController {


    public function index()
    {

        $news_list = News::orderBy('id', 'DESC')->get();
        $select = News::orderBy('id', 'ASC')->pluck('title_en','id')->toArray();
        return view('cms.news.index', compact('news_list','select'));
    }


    public function create()
    {
        return view('cms.news.create');
    }

    public function store(Request $request)
    {

        $request->validate(News::$rules);

        $name = $request->input('active', '1');

        $inputs = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path = public_path().'/uploads/news/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $inputs['photo_url'] = $imageName;

        $news= auth()->user()->news()->save(new News($inputs));

        if($news){
          return back()->with('status', 'success');
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
        $news = News::find($id);
        $select = News::orderBy('id', 'ASC')->pluck('title_en','id')->toArray();
        return view("cms.news.edit", compact('news','select'));
    }


    public function update(Request $request, $id)
    {
        $news = News::find($id);

        $request->validate(News::$rules_update);

        $inputs = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/news/'.$news->photo_url) and file_exists(public_path().'/uploads/news/'.$news->photo_url)){
                unlink(public_path().'/uploads/news/'.$news->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/news/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['photo_url'] = $imageName;

        }

        $inputs['user_id'] = auth()->user()->id;

        $news->update($inputs);

        return back()->with('status', 'success');

    }

    public function destroy($id)
    {

        $news = News::find($id);

        if(is_file(public_path().'/uploads/news/'.$news->photo_url) and file_exists(public_path().'/uploads/news/'.$news->photo_url)){
            unlink(public_path().'/uploads/news/'.$news->photo_url);
        }

        News::destroy($id);

        return back()->with('status', 'success');
    }

}
