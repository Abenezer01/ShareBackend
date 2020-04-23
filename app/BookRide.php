<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRide extends Model
{
  protected $primaryKey = "rideBookId";
    public $incrementing = false;

    protected $fillable = [
        'rideOfferId','rideBookId','rideConsumerId','totalPass'
    ];

  public function rideConsumer()
  {
      return $this->belongsTo('App\EndUser', 'rideConsumerId', 'userId');
  }

}
