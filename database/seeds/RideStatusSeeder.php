<?php

use Illuminate\Database\Seeder;
use App\RideStatus;
class RideStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $ride_status = [
        [
          'rideStatusId'=>uniqid('RS-'),
          'name' =>'OnGoing',
          'description' => ''
        ],
        [
          'rideStatusId'=>uniqid('RS-'),
          'name' =>'Canceled',
          'description' => ''
        ],
        [
          'rideStatusId'=>uniqid('RS-'),
          'name' =>'Completed',
          'description' => ''
        ],
        [
          'rideStatusId'=>uniqid('RS-'),
          'name' =>'Hold',
          'description' => ''
        ],
      ];
      foreach ($ride_status as $status) {
        RideStatus::create($status);
      }
    }
}
