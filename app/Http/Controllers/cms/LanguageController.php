<?php namespace App\Http\Controllers\cms;

use Cookie;
use Redirect;

class LanguageController extends BaseController {


	public function change($lang){

		Cookie::queue('lugha', $lang, 43200);

		$lang = Cookie::make('lang', '_'.$lang);



 		return Redirect::back()->withCookie($lang);

	}

}

