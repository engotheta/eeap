<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class SpecialPage extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	public static $rules = [
		'title_en' => 'required|max:191',
		'title_sw' => 'required|max:191',
		'content_en' => 'required',
		'content_sw' => 'required',
	];

	//fillables
	protected $guarded=[];

	protected $table= 'special_pages';

  protected $translatableAttributes = ['title','content'];

  public function sluggable(): array {
      return [
          'slug' => [
              'source' => 'title_en'
          ]
      ];
  }

	public function documentCategories()
	{
		return $this->hasMany('App\Models\DocumentCategory', 'specials', 'id')
		->with('documents')
		->whereHas('documents',function($q){
			$q->where('active','=',1);
		})
		->where('active','=',1)
		->orderBy('created_at', 'DESC');
	}

	public function services()
	{
		return $this->hasMany('App\Models\Service', 'specials', 'id')
		->with('documentCategories')
		->whereHas('documentCategories',function($q){
			$q->where('active','=',1)
				->with('documents')
				->whereHas('documents',function($r){
					$r->where('active','=',1);
				});
		})
		->where('active','=',1)
		->orderBy('created_at', 'DESC');
	}

	public function faqs()
	{
		return $this->hasMany('App\Models\Faq', 'specials', 'id')
		->where('active','=',1)
		->orderBy('created_at', 'DESC');
	}

	public function photos()
	{
		return $this->hasMany('App\Models\Gallery', 'specials', 'id')
		->where('status','=',1)
		->with('photos')
		->orderBy('created_at', 'DESC');
	}
}
