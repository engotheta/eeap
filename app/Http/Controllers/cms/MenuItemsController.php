<?php namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem as MenuItem;
use Illuminate\Http\Request;
use Response;
use App\Models\RelatedLink;
use App\Models\ImportantLink;
use App\Models\QuickLink;
use App\Models\SocialLink;
use App\Models\AboutLink;
use App\Models\SupportLink;
use App\Models\IctLink;

class MenuItemsController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('acl');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($menuID)
    {
        $menu              = Menu::findOrFail($menuID);
        $menuItem          = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $pages             = array();

        if ($menu->category == 'ministry_info') {
            $selectmenu = Menu::ministryselectMenu();
        }else{
            $selectmenu = Menu::selectMenu();
        }
        
        // return "hello";
        return View('cms.menus.menu_items.index', compact(array(/*'menuitems', 'parents',*/ 'selectmenu', /*'categories', */'menuItem', 'menu')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();


        if($request->link == 0) {
            $data['url'] = $request->url_external;
        }else{
            $data['url_external'] = NULL;
        }

        $data['position'] = MenuItem::where('parent','=',0)->max('position')+1;

        $menu_item=MenuItem::create($data);


        return redirect()->route('cms.menu-items.index', $data['menu_id'])->with('status','success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $menuitem = MenuItem::find($id);
        $menu = Menu::find($menuitem->menu_id);
        $pages    = array();

        if ($menu->category == 'ministry_info') {
            $selectmenu = Menu::ministryselectMenu();
        }else{
            $selectmenu = Menu::selectMenu();
        }

        return View('cms.menus.menu_items.edit', compact(array('selectmenu','menuitem','menu')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    function update($id, Request $request)
    {
        // dd($request->all());
        $menuitem = MenuItem::findOrFail($id);

        $data = $request->all();

        if($request->link == 0) {
            $data['url'] = $request->url_external;
        }else{
            $data['url_external'] = NULL;
        }


        // $data['position'] = MenuItem::where('parent', '=', 0)->max('position') + 1;

        $menuitem->update($data);


        return redirect()->route('cms.menu-items.index', $data['menu_id'])->with('status','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    function destroy($id)
    {
        $menuitem = MenuItem::findOrFail($id);
        
        $this->destroy_helper($menuitem->id);
        return redirect()->route('cms.menu-items.index',$menuitem->menu_id)->with('status','success');
    }

    //helper function to help deleting menu childs
    function destroy_helper($menu_id)
    {
        $menuitem = MenuItem::findOrFail($menu_id);
        $children = MenuItem::where('parent',$menuitem->id)->orderBy('position','ASC')->get();
        $menuitem->delete();

        if(count($children)){
            foreach($children as $child){
                $this->destroy_helper($child->id);
            }
        }
    }
    

    //Meu update functions
    function ajax_link_update($slug, Request $request)
    {
        global $family;

        $family = array();

        if($slug == 'RelatedLink') {
            $model = new RelatedLink();
        }else if($slug == 'QuickLink') {
            $model = new QuickLink();
        }else if($slug == 'ImportantLink') {
            $model = new ImportantLink();
        }else if($slug == 'SocialLink') {
            $model = new SocialLink();
        }else if($slug == 'AboutLink') {
            $model = new AboutLink();
        }else if($slug == 'SupportLink') {
            $model = new SupportLink();
        }else if($slug == 'IctLink') {
            $model = new IctLink();
        }

        function getchildren($parent)
        {
            global $family;

            if (isset($parent->children)) {

                foreach ($parent->children as $child) {

                    $family[] = array('p' => $parent->id, 'c' => $child->id);

                    if (isset($child->children)) {
                        getchildren($child);
                    }
                }

            } else {

            }
        }

        $menuitems  = $request->all();
        // return Response::json($menuitems);
        $parent_pos = json_decode($menuitems['positions']);

        $menuitems = json_decode($menuitems['data']);

        foreach ($menuitems as $m) {
            getchildren($m);
        }

        $i = 1;
        foreach ($parent_pos as $p) {
            $model::where('id', '=', $p)->update(array('position' => $i, 'parent' => 0));
            $i++;
        }

        // 2021-11-07 (frednand.masasi) new ajax update... previous could not properly update links with children
        $change_parent = array();

        foreach ($family as $member) {
            if (array_key_exists($member['p'], $change_parent)) {
                $change_parent[$member['p']]++;

            } else {
                $change_parent[$member['p']] = 1;
            }

            $position = $change_parent[$member['p']];

            $model::where('id', '=', $member['c'])->update(array('position' => $position, 'parent' => $member['p']));
        }

        return Response::json($menuitems);
    }

    //Meu update functions
    function ajax_update(Request $request)
    {
        global $family;

        $family = array();

        function getchildren($parent)
        {
            global $family;

            if (isset($parent->children)) {

                foreach ($parent->children as $child) {

                    $family[] = array('p' => $parent->id, 'c' => $child->id);

                    if (isset($child->children)) {
                        getchildren($child);
                    }
                }

            } else {

            }
        }

        $menuitems  = $request->all();
        $parent_pos = json_decode($menuitems['positions']);

        $menuitems = json_decode($menuitems['data']);

        foreach ($menuitems as $m) {
            getchildren($m);
        }

        $i = 1;
        foreach ($parent_pos as $p) {
            MenuItem::where('id', '=', $p)->update(array('position' => $i, 'parent' => 0));
            $i++;
        }

        
        // 2021-11-07 (frednand.masasi) new ajax update... previous could not properly update links with children
        $change_parent = array();

        foreach ($family as $member) {
            if (array_key_exists($member['p'], $change_parent)) {
                $change_parent[$member['p']]++;

            } else {
                $change_parent[$member['p']] = 1;
            }

            $position = $change_parent[$member['p']];

            MenuItem::where('id', '=', $member['c'])->update(array('position' => $position, 'parent' => $member['p']));
        }

        return Response::json($menuitems);
    }

    #ajax called function below
    function home_menu()
    {

        $menuitems = MenuItem::select('id', 'title_en')->where('menu_name', '=', Input::get('type'))->where('parent', '=', 0)->get();
        $menu      = '<option value="0">None</option>';
        foreach ($menuitems as $item) {
            $selected = ($item->id == Input::get('selected')) ? 'selected' : '';
            $menu     = $menu . "<option value='{$item->id}' {$selected}>{$item->title_en}</option>";
        }
        echo $menu;

    }

}
