<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Seo extends Model implements TrackableInterface{

    use TrackableTrait,Multilingual;

    protected $table = 'seo';
    protected $guarded=[];


    protected $translatableAttributes = ['keywords','content'];

    public static $rules = [
         'keywords_sw' => 'required',
         'keywords_en' => 'required',
         'content_en' => 'required',
         'content_sw' => 'required'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            // 'slug' => [
            //     // 'source' => 'title_en'
            // ]
        ];
    }


}
