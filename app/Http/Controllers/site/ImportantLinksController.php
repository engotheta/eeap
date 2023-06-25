<?php namespace App\Http\Controllers\site;

use App\Http\Controllers\site\BaseSiteController;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ImportantLink;

use Response;
class ImportantLinksController extends BaseSiteController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = ImportantLink::orderBy('position', 'ASC')->get();
        return view('site.importantlinks.index', compact('links'));
    }


}
