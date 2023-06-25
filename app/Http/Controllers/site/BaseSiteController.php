<?php namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

use App\Models\Administration;
use App\Models\QuickLink;
use App\Models\Events;
use App\Models\QuicklinkCategory;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\RelatedLink;
use App\Models\ImportantLink;
use App\Models\MediaLink;
use App\Models\DocumentCategory;
use App\Models\Documents;
use App\Models\SocialLink;
use App\Models\PressRelease;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Seo;
use App\Models\Partner;
use App\Models\Announcement;
use App\Models\RegionalOffice;
use App\Models\OnlineService;
use App\Models\GoogleMap;
use App\Models\Menu;
use App\Models\Faq;
use App\Models\Background;
use App\Models\AboutLink;
use App\Models\SupportLink;
use App\Models\IctLink;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Response;

class BaseSiteController extends Controller {

    protected $relatedLinks;
    protected $host;
    protected $services;
  	protected $quickLinks;
  	protected $importantLinks;
  	protected $mediaLinks;
  	protected $quicklink_categories;
  	protected $social_links;
    protected $contact;
    protected $recent_news;
    protected $recent_announcements;
    protected $recent_events;
    protected $events;
    protected $galleries;
    protected $photos;
    protected $publications;
    protected $google_maps;
    protected $video;
    protected $left_events;
    protected $hq;
    private $seo;
    private $offices;
    private $videos;
    private $online_services;
    private $background;
    private $aboutLinks;
    private $supportLinks;
    private $ictLinks;
    private $news_archive;


    public function __construct()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');

        View::share('host', \request()->server('HTTP_REFERER'));

        View::share('seo',  Seo::first());

        //View::share('quicklink_categories', QuicklinkCategory::With('quicklinks')->orderBy('id', 'ASC')->take(3)->get());

        View::share('quickLinks', QuickLink::orderBy('position', 'ASC')->take(7)->get());

        View::share('faqs', Faq::orderBy('id', 'DESC')->get());

        //View::share('offices', RegionalOffice::orderBy('id', 'DESC')->take(5)->get());

        View::share('headquarter', RegionalOffice::where('headquarter', 1)->orderBy('id','ASC')->first());

        // View::share('active_suggestion_category', SuggestionCategory::where('active',1)->first());

        View::share('social_links', SocialLink::orderBy('position', 'ASC')->take(9)->get());

        View::share('partners', Partner::orderBy('position', 'ASC')->get());

        // View::share('warehouses_map', GoogleMap::where('office_id',999)->first());

        View::share('latest_documents', Documents::where('active',1)->orderBy('id', 'DESC')->take(5)->get());
        // View::share('sponsorLinks', Sponsor::orderBy('id', 'ASC')->take(9)->get());

        View::share('relatedLinks', RelatedLink::orderBy('position', 'ASC')->take(9)->get());

        View::share('importantLinks', ImportantLink::orderBy('position', 'ASC')->take(9)->get());

        View::share('mediaLinks', MediaLink::orderBy('position', 'ASC')->take(9)->get());

        // View::share('aboutLinks', AboutLink::orderBy('position', 'ASC')->take(9)->get());

        View::share('supportLinks', SupportLink::orderBy('position', 'ASC')->take(9)->get());

        // View::share('ictLinks', IctLink::orderBy('position', 'ASC')->take(9)->get());

        View::share('background', Background::orderBy('id','DESC')->first());

        // View::share('howDoIs', HowDoI::where('active', true)->take(4)->get());

         View::share('news_and_events', News::orderBy('id', 'DESC')->where('active','=',1)->take(3)->get());

        // special for the news archieves data
        $this->news_archive = News::distinct()->where('active','=',1)
          ->select(DB::raw("DATE_FORMAT(`created_at`, '%Y-%m') AS 'year_month', YEAR(`created_at`) AS 'year', MONTHNAME(`created_at`) AS 'month'"))
          ->latest()->get();
        if(count($this->news_archive)){
          foreach ($this->news_archive as $key => $archive) {
            $archive_list[$archive->year][$archive->month]['year_month'] = $archive->year_month;
          }
          View::share('news_archive', $archive_list);
        }else{
          View::share('news_archive', array());
        }

        
        // View::share('recent_events', Events::orderBy('event_date', 'DESC')->where('active','=',1)->limit(3)->get());

        // View::share('news_and_events',
        //   Events::orderBy('event_date', 'DESC')->where('active','=',1)->limit(2)->get()->merge(
        //   News::orderBy('id', 'DESC')->where('active','=',1)->take(2)->get()
        // )->sortByDesc('created_at'));

        // View::share('recent_announcements', Announcement::orderBy('id', 'DESC')->where('active','=',1)->take(4)->get());
        
        //  View::share('online_services', OnlineService::orderBy('position', 'ASC')->where('active','=',1)->take(4)->get());

        // $this->galleries = Gallery::where('type','=','photos')->where('featured',0)->with('photos')->orderBy('created_at', 'DESC')->paginate(5);
        // View::share('galleries', $this->galleries);

        // $this->videos = Gallery::where('type','=','videos')->where('featured',1)->with('videos')->orderBy('created_at', 'DESC')->take(4)->get();
        // View::share('video_slider', $this->videos);

        // $this->videos = Gallery::where('featured', 1)->where('type', '=', 'videos')->first();
        // if ($this->videos == null) {
        //     View::share('video_slider', null);
        // } else {
        //     View::share('video_slider', $this->videos->videos()->orderBy('id', 'DESC')->first());
        // }

        // View::share('recent_publications', Documents::orderBy('id', 'DESC')->where('active','=',1)->take(5)->get());

        //View::share('recent_press_releases', PressRelease::orderBy('id', 'DESC')->where('active', 1)->limit(6)->get());
    
        // View::share('dg', Administration::where('position', '=', 1)->first());  
        
    }
}
