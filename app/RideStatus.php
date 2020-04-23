<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideStatus extends Model
{  protected $primaryKey = "rideStatusId";
  public $incrementing = false;


  protected $fillable = [
      'rideStatusId','name','description','color'
  ];

  public function rideOffers()
  {
      return $this->hasMany('App\RideOffer', 'rideStatusId', 'rideStatusId');
  }

}
