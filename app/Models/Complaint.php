<?php

namespace App\Models;

use App\Complainant;
use App\GrievanceLevel;
use Illuminate\Database\Eloquent\Model;


class Complaint extends Model
{


    protected $guarded = [];

    public static $rules = [
        'first_name' => 'required|max:191',
        // 'last_name' => 'required|max:191',
        // 'address' => 'max:191',
        'organization' => 'max:191',
        'subject' => 'required|max:191',
        'email' => 'required|email|max:191',
        'phone' => 'required|max:25',
        // 'customer_type' => 'required',
        // 'complainant_id' => 'required',
        // 'grievance_level_id' => 'required',
        'message' => 'required',
        // 'defect' => 'required',
        // 'location' => 'required',
        // 'date' => 'required',
        // 'complained_before' => 'required'
        // 'g-recaptcha-response' => 'required'
    ];

    protected $fillable = [
        'first_name',
        'middle_name'.
        'last_name',
        'address' ,
        'subject' ,
        'phone',
        'work',
        'fax',
        'designation',
        'organization',
        'customer_type' ,
        'complainant_id' ,
        'grievance_level_id' ,
        'message' ,
        'defect' ,
        'location' ,
        'date',
        'complained_before',
        'email'
    ];

    public function complainant()
    {
        return $this->belongsTo(Complainant::class, 'complainant_id');
    }

    public function grievance_level()
    {
        return $this->belongsTo(GrievanceLevel::class, 'grievance_level_id');
    }
}
