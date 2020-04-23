<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
  protected $primaryKey = "vehicleId";
  public $incrementing = false;
  protected $fillable = [
      'vehicleId','brand', 'model','year', 'plateNo','userId','isActive'
  ];
  public function user()
  {
      return $this->belongsTo('App\EndUser', 'userId', 'userId');
  }

  public function rides()
  {
      return $this->hasMany('App\RideOffer', 'vehicleId', 'vehicleId');
  }

}
