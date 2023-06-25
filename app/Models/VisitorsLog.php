<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsLog extends Model
{
	protected $fillable = ['browserId','userAgent','browserVersion','browserName','os','osVersion'];
}
