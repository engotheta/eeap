<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\SpecialPage;


class FaqsController extends BaseController {

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->paginate(8);
        $specials = SpecialPage::pluck('title_en', 'id');

        return view('cms.faqs.index', compact('faqs', 'specials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate(Faq::$rules);


        $faq = Faq::create($request->all());

        if($faq){
            return redirect('cms/faqs')->with('status', 'success');
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
        $faq = Faq::find($id);
        $specials = SpecialPage::pluck('title_en', 'id');

        return view("cms.faqs.edit", compact('faq','specials'));
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
        $request->validate(Faq::$rules);

        $faq = Faq::find($id);

        $faq->update($request->all());

        return redirect('cms/faqs')->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::destroy($id);

        return redirect('cms/faqs')->with('status', 'success');
    }

}
