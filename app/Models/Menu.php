<?php namespace App\Models;

use App\Traits\Multilingual;
use App\Traits\TrackableInterface;
use App\Traits\TrackableTrait;
use Illuminate\Database\Eloquent\Model;
use Request;


class Menu extends Model implements TrackableInterface
{

    use TrackableTrait, Multilingual;
    // rules
    public static $rules = [
        'title_en' => 'required|max:191',
        'title_sw' => 'required|max:191',
        'category' => 'required',
    ];

    //fillables
    //protected $fillable = ['title_en', 'title_sw', 'category', 'status'];
    protected $guarded = [];

    protected $translatableAttributes = ['title'];

    public function menu_items()
    {
        return $this->hasMany('App\Models\MenuItem');
    }


    public static function selectMenu()
    {

        $pages_all = [];
        // $eventcategories = [];
        // $biographies = [];
        $administration_categories = [];
        $services_all = [];
        //$events =[];
//        $products_all =[];
        $categories = [];
        // $specialPages = [];


        // foreach (Biography::all() as $cat) {
        //   $biographies['biographies/' . $cat->slug] = $cat->salutation.' '.$cat->name;
        // }

//        foreach (Page_category::all() as $cat) {
//            $pages[$cat->title_en] = [];
            foreach (Page::all() as $page) {
                $pages_all['pages/' . $page->slug] = $page->title;
              }
//        }

        // foreach (SpecialPage::all() as $page) {
        //     $specialPages['pages/s/' . $page->slug] = $page->title;
        // }
        
        foreach (DocumentCategory::all() as $cat) {
            $categories['publications/' . $cat->slug] = $cat->title;
        }

        $license_categories = [];
        foreach (LicensedEntityCategory::all() as $cat) {
            $license_categories['licensed-entities/' . $cat->slug] = $cat->title;
        }

        //for administration... add Organogram First...
        // foreach (Organogram::all() as $organogram) {
        //     $administration_categories['organogram'] = $organogram->title;
        // }

        $administration_categories = [];
        foreach (AdministrationCategories::all() as $admincategory) {
            $administration_categories['administration/' . $admincategory->slug] = $admincategory->title;
        }

        $services_all = [];
        foreach (Service::all() as $service) {
            $services_all['services/' . $service->slug] = $service->title;
        }
        
//        foreach (ProductCategory::all() as $product) {
//            $products_all['product-categories/' . $product->slug] = $product->title;
//        }

        $publications = ['Publications' => $categories];
        $license_categories_ = ['Registered Entities' => $license_categories];
        //$events = ['Events' => $events];
        $administration = ['Administration' => $administration_categories];
        $services = ['Services' => $services_all];
//        $products = ['Our Products' => $products_all];
        $pages = ['Pages' => $pages_all];
        // $specialPages = ['Special Pages' => $specialPages];
        // $biographies = ['Biographies' => $biographies];

        return array_merge(array(
            '#' => 'None',
            'Modules' => array(
                'welcome' => "Welcome",
                'commissioner-desk' => "Commissioners Desk",
                // 'announcements' => "Announcements",
                'news' => "News",
                'events' => "Events",
                'speeches' => "Speeches",
                'press-releases' => "Press Releases",
                'publications' => "Documents Center",
                // 'online-services' => "Online Services",
                // 'products' => "Products",
                // 'trainings' => "Training",
                // 'operators' => "Operators",
                // 'warehouses' => "Warehouses",
                // 'colateral-managers' => "Colateral Managers",
                // 'achievements' => "Achievements",
                // 'hospitals' => "Hospitals",
                // 'howdois' => "How Do I?",
                'services' => "All Services",
                'faqs' => "FAQs",
                'contacts' => "Contact Us",
                'complaints' => "Feedback",
                // 'campaigns' => "Campaigns",
                // 'whistle-blower' => "Whistle Blower",
                'offices' => "Offices",
                'sitemap' => "Sitemap",
            ),
            'Galleries' => array('galleries/listing/photos' => 'Photo gallery', 'galleries/listing/videos' => 'Video Gallery')
            ),
            $publications,
            $license_categories_,
            // $products,
            $services,
            $administration,
            $pages,
            //$specialPages
        );

    }


    public static function boot()
    {

        parent::boot();

        static::deleting(function ($menu) {

            if (!$menu->menu_items->count()) {
                return true;
            }
            return false;
        });

    }

}
