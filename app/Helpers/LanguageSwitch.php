<?php namespace App\Helpers;
use App;
use Cookie;

class LanguageSwitch {
 	protected $lang;
	public static $test;
	protected $data;

	static function langchk(){
		if(Cookie::get('lang') == NULL)	{
			$lang = '_sw';
			App::setLocale('sw');
		}else{
			App::setLocale(substr(Cookie::get('lang'),1,4));
			$lang = Cookie::get('lang');
		}
		self::$test = $lang;
	}

 	public static function label($name){
	 	return Lang::get("labels.{$name}");
	}

	public static function curlang(){
		//return  URL::to("language/".substr(BaseController::getlang(),1,3));
		//dd(self::$test);
		self::langchk();
		return self::$test;
	}

	public static function langdb($name){
		return $name.$lang;
	}

	public static function getField($value,$field){
		return $value->{$field.curlang()};
	}

}


?>
