<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Quote;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use Validator;

class QuotesController extends BaseController {


    public function index()
    {

        $quotes = Quote::orderBy('id', 'DESC')->paginate(15);
        $select = Quote::orderBy('id', 'ASC')->pluck('title_en','title_sw','id')->toArray();
        return view('cms.quotes.index', compact('quotes','select'));
    }


    public function create()
    {
        return view('cms.quotes.create');
    }

    public function store(Request $request)
    {

        $request->validate(Quote::$rules);

        $name = $request->input('active', '1');

        $inputs = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis').'.'.$type);

        $path = public_path().'/uploads/quotes/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $inputs['photo_url'] = $imageName;

        $quote= auth()->user()->quotes()->save(new Quote($inputs));

        if($quote){
//          return back()->with('status', 'success');
          return redirect('cms/quotes')->with('status', 'success');
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
        $quote = Quote::find($id);
        $select = Quote::orderBy('id', 'ASC')->pluck('title_en','title_sw','id')->toArray();
        return view("cms.quotes.edit", compact('quote','select'));
    }


    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);

        $request->validate(Quote::$rules);

        $inputs = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/quotes/'.$quote->photo_url) and file_exists(public_path().'/uploads/quotes/'.$quote->photo_url)){
                unlink(public_path().'/uploads/quotes/'.$quote->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type);

            $path = public_path().'/uploads/quotes/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['photo_url'] = $imageName;

        }

        $inputs['user_id'] = auth()->user()->id;

        $quote->update($inputs);

        return redirect('cms/quotes')->with('status', 'success');

    }

    public function destroy($id)
    {

        $quote= Quote::find($id);

        if(is_file(public_path().'/uploads/quotes/'.$quote->photo_url) and file_exists(public_path().'/uploads/quotes/'.$quote->photo_url)){
            unlink(public_path().'/uploads/quotes/'.$quote->photo_url);
        }

        Quote::destroy($id);

        return back()->with('status', 'success');
    }

}
