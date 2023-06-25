<?php

use App\Helpers\LanguageSwitch;
use App\Models\Translation;

//Do not change the name of labels files in language folder
function label($name)
{
    $trans = Translation::where([
        'keyword' => $name,
    ])->pluck(substr(curlang(), 1))->first();

    if (empty($trans))
        return $name;
    return $trans;
}

function curlang()
{
    //return  URL::to("language/".substr(BaseController::getlang(),1,3));
    return LanguageSwitch::curlang();
}

function langdb($name)
{
    return $name . LanguageSwitch::curlang();
}

function getField($value, $field)
{
    return $value->{$field . curlang()};
}

function halveString($word)
{
    $length = strlen($word);
    $halfplus = ($length / 2) + 1;
    $sub1 = substr($word, 0, $halfplus);
    $sub2 = substr($word, $halfplus);
    $tagword = "<span>" . $sub1 . "</span>" . $sub2;
    return $tagword;
}