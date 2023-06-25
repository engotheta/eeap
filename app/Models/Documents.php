<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Documents extends Model implements TrackableInterface{

	use TrackableTrait,Multilingual;

	protected $guarded=[];


    protected $translatableAttributes = ['title'];

	public static $rules = [
		'title_sw' => 'required|max:191',
		'title_en' => 'required|max:191',
		'file_en' => 'required|max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'file_sw' => 'required|max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'active' => 'required',
		'published_date' => 'required'
	];
	
	public static $rules_update = [
		'title_sw' => 'required|max:191',
		'title_en' => 'required|max:191',
		'active' => 'required',
		'file_en' => 'max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'file_sw' => 'max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'published_date' => 'required'
	];


	public function category(){
		return $this->belongsTo('App\Models\DocumentCategory', 'category_id');
	}

}
