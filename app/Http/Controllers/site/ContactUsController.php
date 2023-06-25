<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Models\Contact;
use App\Models\EmailConfiguration;
use App\Models\RegionalOffice;
use App\Models\GoogleMaps;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Response;
use Validator;


class ContactUsController extends BaseSiteController
{


    /**
     * Display a listing of the resource.
     * GET /contact
     *
     * @return Response
     */
    public function index()
    {
        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->with('maps')->paginate(4);
        return view('site.contactus.index', compact('regional_offices'));
    }

}
