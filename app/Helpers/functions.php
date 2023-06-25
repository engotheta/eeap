<?php

 use App\Models\MenuItem as MenuItem;
 use App\Models\Page as Page;
 use App\Models\Gallery as Gallery;
 use App\Models\AdministrationCategory as AdministrationCategory;
 use App\Models\Administration as Administration;
 use Carbon\Carbon;
 use App\Models\RelatedLink;
 use App\Models\ImportantLink;
 use App\Models\QuickLink;
 use App\Models\SocialLink;
 use App\Models\AboutLink;
 use App\Models\SupportLink;
 use App\Models\IctLink;
 use Illuminate\Support\Facades\File as File;
 use Illuminate\Support\Str;


function permission($permissions) {
    $permissions = is_array($permissions)? $permissions : [$permissions];
    foreach ($permissions as $key => $permission) {
        $routeName = explode('.',$permission)[1];
        $permissionArray = [
            'cms.'.$routeName.'.index',
            'cms.'.$routeName.'.create',
            'cms.'.$routeName.'.store',
            'cms.'.$routeName.'.edit',
            'cms.'.$routeName.'.update',
            'cms.'.$routeName.'.show',
            'cms.'.$routeName.'.destroy'
            ];

        foreach ($permissionArray as $item) {

            if (auth()->user()->can($item)): return true; endif;
        }
    }
    return false;
}

function activeLink($paths_given) {
  // get the entire url and create array
  $url_array = explode('/', $_SERVER['REQUEST_URI']);
  if (count($url_array) > 2) {
    // check if next element exist
    $cms_next_path_key = array_search('cms', $url_array) + 1;
    $cms_next_path_key = (array_key_exists($cms_next_path_key, $url_array))? array_search('cms', $url_array) + 1 : array_search('cms', $url_array);
  }else {
    $cms_next_path_key = array_search('cms', $url_array);
  }

  // echo json_encode('supa dupa manyasi');exit;
  echo (in_array($value = $url_array[$cms_next_path_key], $paths_given))? " active ega-trigger": '';
}

function breadcrumb() {
  $demoName = '/'.strtoLower(env('APP_NAME')).'/'; // remove demo dir name on uri
  $uri = str_replace($demoName, '/', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
  $uri = preg_replace('/^\//', '', $uri, 1);
  
  $last_item = MenuItem::where('url','=',$uri)->first();
  $breadcrumbList = [];

  if (! empty($last_item)) {
    array_push($breadcrumbList, $last_item->title);
    previousBreadcrumbItem($last_item, $breadcrumbList);
  }

}

function previousBreadcrumbItem($breadcrumbPage, $breadcrumbList){

  if ($breadcrumbPage->parent > 0) {
    $parent = MenuItem::where('id','=',$breadcrumbPage->parent)->first();
    array_push($breadcrumbList, $parent->title);
    previousBreadcrumbItem($parent, $breadcrumbList);
  } else {
    $breadcrumbList = array_reverse($breadcrumbList, true);

    foreach ($breadcrumbList as $key => $item) {
      if ($key == array_key_last($breadcrumbList)) {
        echo '<li class="breadcrumb-item list-inline-item active">'.$item.'</li>';
      }else {
        echo '<li class="breadcrumb-item list-inline-item">'.$item.'</li>';
      }
    }
  }
}


function str_limit($string, $limit) {
    return str::limit($string, $limit);
}

function status($id){
	switch($id){
		case "0":
		return "Inactive";
		break;
		case "1":
		return "Active";
		break;
	}

}

function utube_hash($url){
	$temp=$url;
		$url = explode('=', $url);
		if(isset($url[1])){
		  if(strpos($url[1], '&')){
		  	$url = explode('&', $url[1]);
		  	return $url[0];
		  }
		  else {
			return $url[1];
			}
		}
		else {
			$url = $temp;
			$url = explode ('/',$url);
			if(isset($url[count($url)-1])){
				return $url[count($url)-1];
			}
			else {
				return "";
			}
		}
}


function youtube_thumbnail($url) {
  return 'https://img.youtube.com/vi/'.utube_hash($url).'/hqdefault.jpg';
}

function recursiveMenu($parent=0,$menu_id=0,$menu_name='main_nav'){

	static $flag = true;

	if($flag){
		$menu_items = MenuItem::where('menu_id', '=', $menu_id)->where('parent', '=', $parent)->orderBy('position', 'ASC')->get();
		$flag = false;
	}
	else{
		$menu_items = MenuItem::where('menu_id', '=', $menu_id)->where('parent','=',$parent)->orderBy('position','ASC')->get();
	}

	foreach ($menu_items as $key => $child) {
		echo '<li class="dd-item" data-id="'.$child->id.'">
           <div class="dd-handle">'.htmlentities($child->title_en).'</div>
             <span class="dropd"><i class="feather icon-chevrons-down"></i></span>
               <div class="render-forms"></div>';

		openOrderedList($child);

		recursiveMenu($child->id,$child->menu_id);

		closeOrderedList($child);
		echo '</li>';
	}
	return;
}

function recursiveLinksMenu($parent=0,$linkType='RelatedLink',$active=1){

	static $flag = true;

  if ($linkType == 'RelatedLink') {

    $model = new RelatedLink();
    $delete_url = '/cms/related_links';

  } else if($linkType == 'QuickLink') {

    $model = new QuickLink();
    $delete_url = '/cms/quick_links';

  }
  else if($linkType == 'ImportantLink') {

    $model = new ImportantLink();
    $delete_url = '/cms/important_links';

  }
  else if($linkType == 'AboutLink') {

    $model = new AboutLink();
    $delete_url = '/cms/about_links';

  }
  else if($linkType == 'SupportLink') {

    $model = new SupportLink();
    $delete_url = '/cms/support_links';

  }
  else if($linkType == 'IctLink') {

    $model = new IctLink();
    $delete_url = '/cms/ict_links';

  }
  else{

    $model = new SocialLink();
    $delete_url = '/cms/social_links';

  }

	if($flag){
		$menu_items = $model::where('active', '=', $active)
                          ->where('parent', '=', $parent)
                          ->orderBy('position', 'ASC')->get();
		$flag = false;
	}
	else{
		$menu_items = $model::where('active', '=', $active)
                          ->where('parent','=',$parent)
                          ->orderBy('position','ASC')->get();
	}

	foreach ($menu_items as $key => $child) {

		echo '<li class="dd-item hover-show" data-id="'.$child->id.'">
            <div class="dd-handle">'.
              htmlentities($child->title_en).' | '.$child->url.'
            </div>
             <span class="dd-actions">
             <a href="'.url($child->url).'" target="_blank"><i class="feather icon-eye show-on-hover"></i></a>
              <i class="feather icon-edit show-on-hover" data-toggle="modal" data-target="#OpenModelContainer'.$child->id.'"></i>
              <a href="'.url($delete_url, $child->id).'" class="show-on-hover" data-method="delete" ><i class="feather icon-trash-2"></i></a>
             </span>'
            ;

                 if($model::where('parent','=',$child->id)->count()){
                     echo '<ol class="dd-list">';
                 }

            		recursiveLinksMenu($child->id,$linkType,$active);

                if($model::where('parent','=',$child->id)->count()){
                  echo '</ol>';
                }

		echo '</li>';
	}
	return;
}


function openOrderedList($child){
	if($child->hasChildren()){
			echo '<ol class="dd-list">';
	}
}

function closeOrderedList($child){
	if($child->hasChildren()){
			echo '</ol>';
	}
}


function getFileSize($size){

	$size = $size/1024;
		if(round($size) >= 1024){
			return round($size/(1024))." Mb";
		} else {
			return round($size)." Kb";
		}

}

function deleteUnusedFields($unwanted,&$values){
	foreach ($unwanted as $value) {
		if(isset($values[$value])){
			unset($values[$value]);
		}

	}
	return;
}

function title($info){
	$fields = Illuminate\Support\Collection::make(Config::get('es')['translatable_fields']);
	$title = Config::get('es')['title'];

	$m = array_only($info,$title);
	if(is_array($m)){
		$key = key($m);
		$title = substr($key, 0,strrpos($key,'_'));
	return $info[$title.curlang()];
	}
	return '';
}
