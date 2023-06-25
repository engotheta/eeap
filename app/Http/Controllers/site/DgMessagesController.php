<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DgMessage;
use App\Models\Administration;

use Response;
use Redirect;

class DgMessagesController extends BaseSiteController {

    public function show()
    {
        $dg_message = DgMessage::first();
        $dg = Administration::where('position', '=', 1)->first();
        return view('site.dg_messages.show', compact('dg_message', 'dg'));
    }
}
