<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class MenuItem extends Model  implements  TrackableInterface{

    use TrackableTrait,Multilingual;

    // Don't forget to fill this array

    protected $guarded=[];

    protected $translatableAttributes = ['title'];
    /*protected $fillable = [
    'title'
    ,'menu_id'
        // ,'featured'
    , 'title_sw'
    , 'active'
    , 'menu_name'
    , 'url'
    , 'parent'
    , 'position'
        // , 'user_id'
        // ,'link'
        // ,'has_sidebar'
    ];*/


    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }

    public static function active(){

        return MenuItem::where('active','=',1);

    }


    function menus(){
        return $this->hasMany('menuitem', 'parent')->where('menu_name','=','bottom_menu');
    }

    public static function getMenu($menu_name)
    {

        // IDEA: for top header menu for small devices
        if ($menu_name == 'sm_top_menu') {
            
            $menu = Menu::where('category','=','top_menu')->first();
            
        }else {
            $menu = Menu::where('category','=',$menu_name)->first();

        }


        $menu_string = '';

        $title = 'title';

        if(is_null($menu)){
            return;
        }

        $parent_items = $menu->menu_items()->where('parent', '=', 0)->orderBy('position', 'ASC')->get();
        if(!$parent_items){
            return;
        }



        foreach ($parent_items as $parent) {

            $child_items = $menu->menu_items()->where('parent','=',$parent->id)->orderBy('position', 'ASC')->get();

            if($child_items->count() > 0){
                if ($menu_name == 'footer_menu') {
                    $menu_string .= "<li class='list-inline-item dropdown'><a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' >".htmlentities($parent->title)."</a><ul class='dropdown-menu'>";
                }

                elseif ($menu_name == 'mega_menu') {
                    // TODO: create mega menu option
                }

                else {
                    $menu_string .= "<li class='drop drop-toggle'><a href='#' class='nav-link' data-toggle='drop'>".htmlentities($parent->title)."</a><ul class='drop-menu'>";
                }

                foreach ($child_items as $child) {
                    $grands = $menu->menu_items()->where('parent','=',$child->id)->orderBy('position', 'ASC')->get();
                    if($grands->count()){
                        $menu_string .= "
                                <li class='drop drop-toggle'>
                                    <a class='nav-link' data-toggle='drop' href='#'>".htmlentities($child->title)."</a>"."
                                    <ul class='drop-menu'>";

                        foreach ($grands as $grand) {
                            if ($grand->url_external !== null) {
                                $menu_string .= "<li><a target='_blank' rel='noopener noreferrer' class='' href= '".url($grand->url)."'>".htmlentities($grand->title)."</a></li>";
                            }else{
                                $menu_string .= "<li><a class='' href= '".url($grand->url)."'>".htmlentities($grand->title)."</a></li>";
                            }
                        }

                        $menu_string .= "</ul></li>";
                    }
                    else {
                        if ($child->url_external !== null) {
                            $menu_string .= "<li><a target='_blank' rel='noopener noreferrer' class='' href= '".url($child->url)."'>".htmlentities($child->title)."</a></li>";
                        }else{
                            $menu_string .= "<li><a class='' href= '".url($child->url)."'>".htmlentities($child->title)."</a></li>";
                        }
                    }
                }
                $menu_string .= "</ul></li>";


            }else{

                if ($menu_name == 'top_menu') {
                    // open new tab for external url
                    if ($parent->url_external !== null) {
                        $menu_string.= "<li class='list-inline-item'><a target='_blank' rel='noopener noreferrer' href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }else {
                        $menu_string.= "<li class='list-inline-item px-2'><a href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }
                }

                elseif ($menu_name == 'sm_top_menu') {
                    // open new tab for external url
                    if ($parent->url_external !== null) {
                        $menu_string.= "<li class='nav-item xs-show'><a class='nav-link' target='_blank' rel='noopener noreferrer' href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }else {
                        $menu_string.= "<li class='nav-item xs-show'><a class='nav-link' href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }

                }

                elseif ($menu_name == 'footer_menu') {
                    $menu_string.= "<li class='list-inline-item'><a href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                }

                elseif ($menu_name == 'mega_menu') {
                    // TODO: create mega menu option
                }

                else {
                    // open new tab for external url
                    if ($parent->url_external !== null) {
                        $menu_string.= "<li class=''><a class='nav-link' target='_blank' rel='noopener noreferrer' href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }else {
                        $menu_string.= "<li class=''><a class='nav-link' href='".url($parent->url)."'>".htmlentities($parent->title)."</a></li>";
                    }
                }
                
            }

            // $menu_string .= "</li>";
        }

        return $menu_string;
    }

    public function hasChildren(){
        $count = $this::where('parent','=',$this->id)->count();
        if($count){
            return true;
        }

        return false;
    }


    public static function getOtherMenu($menu_name = ''){
        $data = '';
        $title = 'title'.$lang;

        $menu_items = MenuItem::where('menu_name', '=', $menu_name)->where('parent', '=', 0)->get();

        foreach ($menu_items as $menu_item) {
            $data .= "<li ><a href='".URL::to($menu_item->url)."' >".htmlentities($menu_item->title)."</a></li>";
        }

        return $data;
    }

    public static function sitemap($menu_name="main_nav", $lang ='_sw')
    {
        $menu = MenuItem::where('menu_name','=',$menu_name);
        $data = '';
        $title = 'title'.$lang;

        if($menu == null){
            return;
        }
        $parent_items = MenuItem::where('menu_name', '=', $menu_name)->where('parent', '=', 0)->get();
        $num_parent_items = count($parent_items);
        $parent_count = 0;
        $menu_array = array();
        foreach ($parent_items as $parent) {
            $child_items = MenuItem::where('parent','=',$parent->id)->get();
            $num_child_items = count($child_items);
            $child_count = 0;

            if($num_child_items > 0){
                $data .= "<li><a href=".URL::to($parent->url).">".htmlentities($parent->title)."<b class='caret'></b></a>";
                $data .= '<ul>';
                foreach ($child_items as $child)
                {
                    $grand_childs = MenuItem::where('parent','=',$child->id)->get();
                    if(count($grand_childs) > 0){
                        $data .="<li><a href=".URL::to($child->url).">".htmlentities($child->title)."</a><ul>";
                        foreach ($grand_childs as $gr) {
                            $grand_grand_childs = $grand_childs = MenuItem::where('parent','=',$gr->id)->get();
                            if(count($grand_grand_childs) > 0){
                                $data .="<li><a href= ".URL::to($gr->url).">".htmlentities($gr->title)."</a><ul>";
                                foreach ($grand_grand_childs as $key => $gr_gr) {
                                    $data .= "<li><a href=".URL::to($gr_gr->url).">".htmlentities($gr_gr->title)."</a></li>";
                                }
                                $data .="</ul></li>";
                            }else{
                                $data .= "<li><a href=".URL::to($gr->url).">".htmlentities($gr->title)."</a></li>";
                            }
                        }
                        $data .="</ul></li>";
                    }else{
                        $data .= "<li><a href= ".URL::to($child->url).">".htmlentities($child->title)."</a></li>";
                    }
                }
                $data .= '</ul>';
            }else{
                $data.= "<li><a href=".URL::to($parent->url).">".htmlentities($parent->title)."</a>";
            }

            $data .= "</li>";
        }
        return $data;
    }

    public static function sideBar($id){
        $parent = MenuItem::where('has_sidebar','=',1)->where('id','=',$id)->first();
        if(!$parent)
            return array();
        $sidebar = MenuItem::where('parent','=',$parent->id)->orderBy('position','ASC')->get();
        return $sidebar;
    }

    public static function getKids($id){
        return MenuItem::where('parent','=',$id)->orderBy('position','ASC')->get();
    }

    public static function footerMenu(){
        return MenuItem::where('menu_name','=','footer_menu')->get();
    }

}
