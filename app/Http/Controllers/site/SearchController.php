<?php

namespace App\Http\Controllers\site;

use App\Http\Requests;
use Elasticsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

//add models used...
use App\Models\PressRelease;
use App\Models\Speech;
use App\Models\News;
use App\Models\Documents;
use App\Models\Faq;
use App\Models\Events;
use App\Models\Page;
use App\Models\Announcement;
use App\Models\Service;
use App\Models\Administration;
use App\Models\HowDoI;

class SearchController extends BaseSiteController
{

    /**
     * Show the form for creating a new resource.
     * GET /search/create
     *
     * @return Response
     */
    /*    public function search(Request $request)
        {

            $client = new Elasticsearch\Client();
            $validator = Validator::make($data = $request->all(), Search::$rules);

            if ($validator->fails())
            {
                return redirect()->to('/');
            }


            //clean user input
            $term = strip_tags($request->q);
            $term = filter_var($term, FILTER_SANITIZE_STRING);

            $search = new Search();

            $results =  $search->searching($term,$request->page);
            return view('site.search.index', compact('results','term'));


        }*/

    public function search(Request $request)
    {
        //dd($request->q);
        $term = preg_replace('/[^A-Za-z0-9\-]/', '',str_limit(trim(strip_tags($request->q)),191));
        $pressResults = [];
        $speechResults = [];
        $publicationResults = [];
        $newsResults = [];
        $serviceResults = [];
        $pageResults = [];
        $faqResults = [];
        $announcementResults = [];
        $eventResults = [];
        $administrationResults = [];
        // $howdoiResults = [];

        if (!empty($term)) {
            if (curlang() == '_en') {
            
                $pressResults = PressRelease::where('name_en', 'like', '%' . $term . '%')->orWhere('name_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->orWhere('file_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                                
                // $speechResults = Speech::where('name_en', 'like', '%' . $term . '%')->orWhere('name_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->orWhere('file_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                
                $publicationResults = Documents::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('file_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $newsResults = News::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_en', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $serviceResults = Service::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_en', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $faqResults = Faq::where('question_en', 'like', '%' . $term . '%')->orWhere('question_sw', 'like', '%' . $term . '%')->orWhere('answer_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $pageResults = Page::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                
                // $eventResults = Events::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_en', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->orWhere('location', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                
                // $announcementResults = Announcement::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                                
                $administrationResults = Administration::where('fullname', 'like', '%' . $term . '%')->orWhere('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','ASC')->get();

                // $howdoiResults = HowDoI::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_en', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

            }else {

                $pressResults = PressRelease::where('name_en', 'like', '%' . $term . '%')->orWhere('name_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->orWhere('file_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                                
                // $speechResults = Speech::where('name_en', 'like', '%' . $term . '%')->orWhere('name_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->orWhere('file_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $publicationResults = Documents::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('file_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $newsResults = News::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                
                $serviceResults = Service::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $faqResults = Faq::where('question_en', 'like', '%' . $term . '%')->orWhere('question_sw', 'like', '%' . $term . '%')->orWhere('answer_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                $pageResults = Page::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                // $eventResults = Events::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('summary_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->orWhere('location', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

                // $announcementResults = Announcement::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();
                
                // $administrationResults = Administration::where('fullname', 'like', '%' . $term . '%')->orWhere('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','ASC')->get();

                // $howdoiResults = HowDoI::where('title_en', 'like', '%' . $term . '%')->orWhere('title_sw', 'like', '%' . $term . '%')->orWhere('content_sw', 'like', '%' . $term . '%')->limit(50)->orderBy('id','DESC')->get();

            }
        }

        //return results to search page...
        return view('site.search.index',
            compact('term',
                'pressResults',
                // 'speechResults',
                'publicationResults',
                'newsResults',
                'serviceResults',
                // 'announcementResults',
                'faqResults',
                'pageResults',
                // 'eventResults',
                'administrationResults'
            )
        );

    }


}
