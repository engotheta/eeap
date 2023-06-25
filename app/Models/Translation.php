<?php namespace App\Models;

use App\Traits\TrackableInterface;
use App\Traits\TrackableTrait;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model implements TrackableInterface
{
    use TrackableTrait;

    protected $table = 'translations';

    // Don't forget to fill this array
    protected $fillable = [
        'en'
        , 'sw'
        , 'keyword'
        , 'created_at'
        , 'updated_at'
    ];

    public static function lang($lang)
    {
        $trans = self::pluck($lang, 'keyword');
        return $trans;
    }

}