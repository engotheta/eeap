<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Photo extends Model implements  TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;


	protected $table ='media';

	// validation rules
	public static $rules = [
		// 'title_en' => 'required',
		// 'title_sw' => 'required',
		'gallery_id' => 'required',
		//'mediaurl' => 'required|image|mimes:jpg,png,jpeg,bmp|max:2000', //if icon is needed
	];

	//fillables
	//protected $fillable = ['title_en', 'title_sw', 'mime', 'content_en', 'content_sw', 'path', 'url','gallery_id', 'filename', 'slug','status','show_content'];
	protected $translatableAttributes = ['title','content'];
	protected $guarded=[];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'filename'
            ]
        ];
    }


   public function gallery(){
	return $this->belongsTo('App\Models\Gallery');
   }
   
	public function image($size=''){
		if($size==''){
			return 'uploads/gallery/'.$this->filename;
		}
		return 'uploads/gallery/'.$this->filename;
	}

}
