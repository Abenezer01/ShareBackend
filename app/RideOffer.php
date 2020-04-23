<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideOffer extends Model
{
    protected $primaryKey = "rideOfferId";
    public $incrementing = false;
//    * The attributes that are mass assignable.
    /**
     *
     * @var array
     */
    protected $fillable = [
        'rideOfferId','userId','vehicleId',
        'pickup','destination','no_of_seats','date',
        'time','price','rideStatusId','originLat',
        'originLong','destinationLong','destinationLat'
    ];
    public function user()
      {
          return $this->belongsTo('App\EndUser', 'userId', 'userId');
      }
      public function status()
      {
          return $this->belongsTo('App\RideStatus', 'rideStatusId','rideStatusId');
      }

      public function vehicle()
      {
          return $this->belongsTo('App\Vehicles', 'vehicleId', 'vehicleId');
      }
}
