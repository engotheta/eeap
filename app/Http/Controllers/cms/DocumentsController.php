<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Documents;
use App\Models\DocumentCategory;

use Auth;
class DocumentsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Documents::orderBy('id', 'DESC')->get();
        $categories = DocumentCategory::pluck('title_en', 'id');
        return view('cms.documents.index', compact('documents', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Documents::$rules);

        $data = $request->except('file');

        if ($request->hasFile('file_sw'))
        {
            if ($request->file('file_sw')->isValid())
            {
                $file_url_sw = $request->file('file_sw');

                $doc_name_sw = 'sw-'.time() . '-' .$file_url_sw->getClientOriginalName();

                $pathName = '/uploads/documents/';

                $destinationPath = public_path().$pathName;

                $file_url_sw->move($destinationPath, $doc_name_sw);

                $data['file_sw'] = $doc_name_sw;

            }
        }

        if ($request->hasFile('file_en'))
        {

            if ($request->file('file_en')->isValid())
            {
                $file_url_en = $request->file('file_en');

                $doc_name_en = 'en-'.time() . '-' .$file_url_en->getClientOriginalName();


                $pathName = '/uploads/documents/';

                $destinationPath = public_path().$pathName;

                $file_url_en->move($destinationPath, $doc_name_en);

                $data['file_en'] = $doc_name_en;

            }
        }

        $document = Documents::create($data);

        if($document){
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
        $document = Documents::find($id);
        $categories = DocumentCategory::pluck('title_en', 'id');
        return view("cms.documents.edit", compact('document', 'categories'));
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
        $document = Documents::find($id);

        $request->validate(Documents::$rules_update);

        $data = $request->except('file_en','file_sw');

        if ($request->hasFile('file_sw'))
        {

            if ($request->file('file_sw')->isValid())
            {
                $file_url_sw = $request->file('file_sw');

                $doc_name_sw = 'sw-'.time() . '-' .$file_url_sw->getClientOriginalName();

                $pathName = '/uploads/documents/';

                $destinationPath = public_path().$pathName;

                $file_url_sw->move($destinationPath, $doc_name_sw);

                if(is_file(public_path().'/uploads/documents/'.$document->file_sw) && file_exists(public_path().'/uploads/documents/'.$document->file_sw)){
                    unlink(public_path().'/uploads/documents/'.$document->file_sw);
                }

                $data['file_sw'] = $doc_name_sw;


            }
        }

        if ($request->hasFile('file_en'))
        {

            if ($request->file('file_en')->isValid())
            {
                $file_url_en = $request->file('file_en');

                $doc_name_en = 'en-'.time() . '-' .$file_url_en->getClientOriginalName();


                $pathName = '/uploads/documents/';

                $destinationPath = public_path().$pathName;

                $file_url_en->move($destinationPath, $doc_name_en);

                if(is_file(public_path().'/uploads/documents/'.$document->file_en) && file_exists(public_path().'/uploads/documents/'.$document->file_en)){
                    unlink(public_path().'/uploads/documents/'.$document->file_en);
                }

                $data['file_en'] = $doc_name_en;

            }
        }

        $document->update($data);

        if ($document) {
          return back()->with('status', 'success');
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

        $document = Documents::find($id);

        if(is_file(public_path().'/uploads/documents/'.$document->file_en) && file_exists(public_path().'/uploads/documents/'.$document->file_en)){
            unlink(public_path().'/uploads/documents/'.$document->file_en);
        }

        if(is_file(public_path().'/uploads/documents/'.$document->file_sw) && file_exists(public_path().'/uploads/documents/'.$document->file_sw)){
            unlink(public_path().'/uploads/documents/'.$document->file_sw);
        }

        Documents::destroy($id);

        return back()->with('status', 'success');
    }

}
