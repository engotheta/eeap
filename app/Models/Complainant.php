<?php

namespace App;

use App\Traits\Multilingual;
use App\Traits\TrackableTrait;
use Illuminate\Database\Eloquent\Model;

class Complainant extends Model
{
    use TrackableTrait, Multilingual;

}
