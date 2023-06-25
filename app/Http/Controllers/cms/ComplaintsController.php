<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Complaint;

use Response;
use Validator;
use Redirect;

class ComplaintsController extends BaseController {

    public function index()
    {
        $complaints = Complaint::orderBy('id', 'DESC')->get();
        return view('cms.complaints.index', compact('complaints'));
    }

    public function show($id){
        $complain = Complaint::find($id);
        return view('cms.complaints.show', compact('complaint'));
    }

    public function destroy($id)
    {
        $complain = Complaint::destroy($id);
        return redirect('cms/complaints');
    }

}
