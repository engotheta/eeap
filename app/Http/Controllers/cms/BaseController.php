<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;

use View;

class BaseController extends Controller {

	protected $settings;

    public function __construct()
    {

        $this->settings = Setting::all();
        View::share('settings', $this->settings);
    }

}
