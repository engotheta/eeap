<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TrackableTrait;
use App\Traits\Multilingual;
use App\Traits\TrackableInterface;

class MediaLink extends Model implements  TrackableInterface{

	use TrackableTrait,Multilingual;

	protected $guarded=[];

    
    protected $translatableAttributes = ['title'];

	public static $rules = [
		'title_en'	=> 'required|max:191',
		'title_sw'	=> 'required|max:191',
		'url'	=> 'required|max:191'
	];


}
