<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EndUser extends Model
{

  protected $primaryKey = "id";
  public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','firstName', 'lastName','phone','gender','email','password'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table='end_users';
    public function avatar(){
      return $this->morphMany('App\Avatar', 'avatarable');
    }
    public function serviceProviders(){
      return $this->belongsToMany('App\CHRLServiceProviders', 'user_service_providers', 'userId', 'serviceProviderId')->withPivot('selected');;
    }

    public function vehicles()
    {
        return $this->hasMany('App\Vehicle', 'id');
    }
}
