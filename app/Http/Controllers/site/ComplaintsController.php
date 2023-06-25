<?php namespace App\Http\Controllers\site;

use App\Complainant;
use App\GrievanceLevel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Contact;
use App\Models\EmailConfiguration;
use App\Models\Seo;
use App\Models\Preference;

use Response;
use Validator;
use Redirect;
use File;
use Mail;

class ComplaintsController extends BaseSiteController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('site.complaints.index');
    }


    public function create()
    {
        $grievance_levels = GrievanceLevel::get();
        $complainants = Complainant::get();

        return view('site.complaints.index', compact('grievance_levels', 'complainants'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['select']);
        $validator = Validator::make($data, Complaint::$rules);

        if ($validator->fails()) {
            return redirect('complaints')->withErrors($validator)->withInput();
        }

        $seo = Seo::first();

        //re-captcha functionality here...
        $captcha = $request->get('g-recaptcha-response');
        $siteKey = $seo->recaptcha_site_key;
        $secretKey = $seo->recaptcha_secret_key;
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);

        // should return JSON with success as true
        if($responseKeys["success"] || true){

            //save complaint to the database before trying to send email...
            $complaint = Complaint::create($request->except('g-recaptcha-response'));

            $email_data = array(
                'names' => $request->get('first_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'subject' => $request->get('subject') ?? 'FEEDBACK, COMPLAINT or OPINION',
                'organization' => $request->get('organization'),
                'text' => $request->get('message'),
                'receiver' => ""
            );

            $preference = Preference::orderBy('id', 'DESC')->first();
            $email_data['receiver'] = ($preference)? $preference->feedback_email : '';

            // dd($email_data['receiver']);

            try {
                //try sending mail..
                Mail::send(['html' => 'site.complaints.email'], $email_data, function ($message) use ($email_data) {
                    $message->to($email_data['receiver'])
                        ->replyTo($email_data['email'], $email_data['names'])
                        ->subject($email_data['subject']);
                });
            } catch(\Exception $e){
                // Mail failed, but feedback savede in DB... 
                // (You can do something else in failure)
            }

            //Just Procced to success page for now...
            return redirect('complaints')->with('status','success');
        
        }else{
            $validator->getMessageBag()->add('g-recaptcha-response', 'Failed: Wrong Recaptcha Response');
            return redirect('complaints')->withErrors($validator)->withInput();
        }
        
    }


    public function success()
    {
        return view('site.complaints.success');
    }


}
