<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\WhistleBlower;
use App\Models\EmailConfiguration;
use App\Models\Seo;
use App\Models\Preference;

use Response;
use Validator;
use Redirect;
use File;
use Mail;

class WhistleBlowersController extends BaseSiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $preference = Preference::orderBy('id', 'DESC')->first();
        //if no preference settings found, don't return the whistle blower form
        if(!$preference) return view('site.default-not-found');

        return view('site.whistle-blower.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), WhistleBlower::$rules);

        if ($validator->fails()) {
            return redirect('whistle-blower')->withErrors($validator)->withInput();
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
        if($responseKeys["success"]){

            $email_data = array(
                'fullname' => $request->get('fullname') ?? 'N/A',
                'email' => $request->get('email') ?? 'N/A',
                'incident_location' => $request->get('incident_location'),
                'incident_extra_info' => $request->get('incident_extra_info') ?? 'N/A',
                'incident_description' => $request->get('incident_description'),
                'subject' => 'WHISTLE BLOWER NOTIFICATION',
                'attachment' => null,
                'receiver' => ""
            );

            if ($request->hasFile('attachment')) {
                if ($request->file('attachment')->isValid()) {
                    $file_url = $request->file('attachment');
                    $doc_name = time() . '-' .$file_url->getClientOriginalName();
                    $destinationPath = public_path().'/uploads/whistleblower/';
                    $file_url->move($destinationPath, $doc_name);
                    $email_data['attachment'] = $destinationPath.$doc_name;
                }
            }

            $preference = Preference::orderBy('id', 'DESC')->first();
            $email_data['receiver'] = ($preference)? $preference->whistle_email : '';
            // dd($email_data['receiver']);

            try {
                //try sending mail..
                if($email_data['attachment']){
                    Mail::send(['html' => 'site.whistle-blower.email'], $email_data, function ($message) use ($email_data) {
                        $message->to($email_data['receiver'])
                            ->subject($email_data['subject'])
                            ->attach($email_data['attachment']);
                    });
                }else{
                    Mail::send(['html' => 'site.whistle-blower.email'], $email_data, function ($message) use ($email_data) {
                        $message->to($email_data['receiver'])
                            ->subject($email_data['subject']);
                    });
                }
                
            } catch(\Exception $e){
                // Mail sending failed...
                // delete first attachment if present
                if($email_data['attachment']){
                    if(is_file($email_data['attachment']) && file_exists($email_data['attachment'])){
                        unlink($email_data['attachment']);
                    }
                }

                return redirect('whistle-blower')->withInput()->with('status','fail');
            }

            //Just Procced to success page for now...
            // delete first attachment if present
            if($email_data['attachment']){
                if(is_file($email_data['attachment']) && file_exists($email_data['attachment'])){
                    unlink($email_data['attachment']);
                }
            }
            return redirect('whistle-blower')->with('status','success');
        
        }else{
            $validator->getMessageBag()->add('g-recaptcha-response', 'Failed: Wrong Recaptcha Response');
            return redirect('whistle-blower')->withErrors($validator)->withInput();
        }
        
    }

}
