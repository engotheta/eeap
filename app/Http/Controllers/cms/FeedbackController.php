<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Feedback;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use Validator;

class FeedbackController extends BaseController {


    public function index()
    {

        $feedbacks = Feedback::orderBy('id', 'DESC')->get();
        return view('cms.feedback.index', compact('feedbacks'));
    }


    public function create()
    {
    }

    public function store(Request $request)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

        Feedback::destroy($id);

        return back()->with('status', 'success');
    }

}
