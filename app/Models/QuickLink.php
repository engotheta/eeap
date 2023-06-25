<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class QuickLink extends Model implements  TrackableInterface{

	use TrackableTrait,Multilingual;

	protected $fillable = ['title_en', 'title_sw','url', 'active','link','url_external','category_id','parent','position'];

	protected $translatableAttributes = ['title'];

	public static $rules = [
		'title_en'	=> 'required|max:191',
		'title_sw'	=> 'required|max:191',
		'link'	=> 'required',
		'url'		=> 'required|max:191',
		//'category_id' => 'required',
	];


	public function category(){
		return $this->belongsTo('App\Models\QuicklinkCategory', 'category_id');
	}


}