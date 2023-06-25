<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\RegionalOffice;
use Illuminate\Http\Request;
use App\Models\Department;

use Response;
use Validator;
use Redirect;

class RegionalOfficesController extends BaseSiteController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->paginate(15);
        return view('site.regional_office.index', compact('regional_offices'));
    }

}