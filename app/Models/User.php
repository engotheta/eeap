<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as UserAuth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordTokenNotification;


class User extends UserAuth
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [ 'name', 'email', 'password'];

    protected $hidden = [ 'password', 'remember_token' ];

    public static $rules =[
    	'email'=>'required|email|unique:users',
    	'name'=>'required|max:191',
    ];

    public static $rules_update =[
    	'email'=>'required|email',
    	'name'=>'required|max:191',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordTokenNotification($token));
    }

    public function sendEmailVerificationMail($password)
    {
        Mail::to($this->email)->queue(new VerifyEmailMail($this, $password));
    }

    public function sendPasswordResetEmail($token, $email)
    {
        Mail::to($this->email)->queue(new PasswordResetMail($token, $email));
    }

    public function sendEmailIsVerifiedMail()
    {
        Mail::to($this->email)->queue(new EmailIsVerifiedMail());
    }

    public function sendPasswordHasBeenResetMail()
    {

        Mail::to($this->email)->queue(new PasswordHasBeenResetMail());
    }


    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function moreInfos()
    {
        return $this->hasMany('App\Models\MoreInfo');
    }

    public function agricultureMaps()
    {
        return $this->hasMany('App\Models\AgricultureMap');
    }


    public function events()
    {
        return $this->hasMany('App\Models\Events');
    }

    public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }

    public function campus()
    {
        return $this->hasMany('App\Models\Campus');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
    
    public function sports()
    {
        return $this->hasMany('App\Models\Sport');
    }

    public function breadcrumbImages()
    {
        return $this->hasMany('App\Models\BreadcrumbImage');
    }



}
