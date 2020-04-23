<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCatagory extends Model
{
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $fillable = [
    'id', 'name', 'description',
  ];

  public function serviceProviders()
  {
    return $this->hasMany('App\CHRLServiceProviders', 'serviceCatagoryId', 'serviceCatagoryId');
  }
  public function logo(){
    return $this->morphMany('App\Image', 'imageable');
  }
  public function getSelectedLogo(){
    return $this->logo()->first();
  }
}
