<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Preference extends Model implements TrackableInterface{

    use TrackableTrait,Multilingual;

    protected $guarded=[];

    protected $translatableAttributes = [];

    public static $rules = [
         'feedback_email' => 'required|email|max:191',
         'whistle_email' => 'required|email|max:191'
    ];

}
