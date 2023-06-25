<?php 
namespace App\Traits;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Cookie;

trait Multilingual
{


    /**
     *  Hijack parent's getAttribute to get the translation of the given field instead of its value.
     *
     *  @param  string  $key  Attribute name
     *  @return mixed
     */
    public function getAttribute($attribute)
    {
        if ($this->isMultilingualAttribut($attribute)) {
            $attribute=$attribute.curlang();
        }

        //Return parent
        return parent::getAttribute($attribute);
    }

    public function isMultilingualAttribut($attribute){
        $attribute_lugha=$attribute.curlang();

        return array_key_exists($attribute_lugha, $this->attributes);
    }

//    public function getLocaleValue(){
//        //Get language value from store cookie
//        $value = curlang();
//
//        /*
//        If no value in the cookie set then take the default locale from app.php
//        and assign it to cookie then return that locale
//        */
//
////        if(!$value){
////            $value = app()->getLocale();
////            Cookie::queue('lugha', $value, 43200);
////            $lang = Cookie::make('lang', '_'.$value);
////        }elseif (!array_key_exists($value, $this->getAvailableLocales())) {
////            $value = app()->getLocale();
////            Cookie::queue('lugha', $value, 43200);
////            $lang = Cookie::make('lang', '_'.$value);
////        }
//
//        return $value;
//    }
//
//    public function getAvailableLocales(){
//        return $availableLocale = array('en'=>'English', 'sw'=>'Kiswahili');
//    }
}
